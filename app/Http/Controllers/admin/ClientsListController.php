<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Client;
use App\Models\Attorney;
use App\Models\CaseType;
use App\Models\Variable;
use App\Models\LeadStatus;
use Illuminate\Support\Str;
use App\Models\ClientStatus;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Models\CaseIntakeField;
use App\Services\ClientService;
use App\Models\OpposingPartyinfo;
use App\Http\Controllers\Controller;
use App\Models\AppointmentLocations;
use App\Models\ClientCaseInformation;
use App\Models\AppointmentColorLegend;
use App\Models\ClientIntakeInformation;
use Illuminate\Support\Facades\Artisan;
use App\Jobs\SendClientVerificationEmail;
use Illuminate\Support\Facades\Validator;

class ClientsListController extends Controller
{
    protected $clientService;
    protected $userService;

    public function __construct(ClientService $clientService, UserService $userService)
    {
        $this->clientService = $clientService;
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'clients_list';
        $this->data['controller'] = 'clients_list';
        $this->data['controller_name'] = 'Clients List';
        $this->data['case_analysts'] = User::all();
        $this->data['case_services'] = CaseType::all();
        $this->data['client_statuss'] = ClientStatus::all();

        $query = Client::type('client')->with('clientCasesInfo.caseType', 'clientStatus', 'leadStatus');

        // Apply filters
        if ($request->filled('client_status')) {
            $query->where('client_status_id', $request->client_status);
        }
        if ($request->filled('case_analyst')) {
            $query->whereHas('clientCasesInfo', function ($q) use ($request) {
                $q->where('case_analyst', $request->case_analyst);
            });
        }
        if ($request->filled('case_service')) {
            $query->whereHas('clientCasesInfo', function ($q) use ($request) {
                $q->where('case_type_id', $request->case_service);
            });
        }
        
        if ($request->filled('case_number')) {
            $query->whereHas('clientCasesInfo', function ($q) use ($request) {
                $q->where('case_number', 'like', '%' . $request->case_number . '%');
            });
        }

        // Get paginated results
        $clients = $query->paginate(5);
        //dd($query->get());


        if ($request->ajax()) {
            $view = view('admin.' . $this->data['controller'] . '.client_list', compact('clients'))->render();

            return response()->json([
                'client_list' => $view,
            ]);
        }

        $this->data['clients'] = $clients;

        return view('admin.' . $this->data['controller'] . '.list')->with($this->data);
    }



    public function clientInfo(Request $request, $id, $client_case_info_id)
    {
        $this->data['sidebar_active'] = 'clients_list';
        $this->data['controller'] = 'clients_list';
        //$this->data['controller_name'] = ' Dennis E';
        $this->data['record'] = Client::with('user')->find($id);
        $this->data['client_case_types']= ClientCaseInformation::with('caseType')->where('client_id', $id)->get();

        if (empty($client_case_info_id) || $client_case_info_id === "undefined") 
        {
            
            $this->data['case_info_record'] = ClientCaseInformation::with('caseType', 'leadSources', 'adPlacement', 'opposingPartyInfo')->where('client_id', $id)->first();

        }
        else
        {
           
            $this->data['case_info_record'] = ClientCaseInformation::with('caseType', 'leadSources', 'adPlacement', 'opposingPartyInfo')->where('id', $client_case_info_id)->first();
        }
        
        $this->data['attorneys'] = Attorney::all();
        $this->data['users'] = User::all();
        $this->data['client_statuses'] = ClientStatus::all();
        $this->data['lead_statuses'] = LeadStatus::all();
        $this->data['appointment_locations'] = AppointmentLocations::all();
        $this->data['email_variables'] = Variable::whereIn('category', ['Both', 'Email'])->get();
        $this->data['case_intake_fields'] = CaseIntakeField::where('visible', 1)->where('case_type', $this->data['case_info_record']->case_type_id)->orderBy('order_number', 'asc')->get();
        
        $this->data['clientIntakeAnswer'] = ClientIntakeInformation::where('client_case_information_id', $client_case_info_id)->get();
        $this->data['case_types'] = getCaseType();
        $this->data['lead_sources'] = getLeadSources();
        $this->data['ad_placements'] = getADPlacement();
        $this->data['appointment_color_legends'] = AppointmentColorLegend::all();
     

        return view('admin.'.$this->data['controller'].'.client_info')->with($this->data);
    }

    public function convertLead(Request $request)
    {
        $leadId = $request->input('id');
        
        try
        {
            $lead = Client::where('id', $leadId)->update
            (
                [
                    'type' => 'client',
                ]
            );
           
            $client = Client::find($request->id);
            $token = Str::random(60);
            /// client info enter into user table
            $data = [
                'name' => $client->primary_client_name,
                'email' => $client->email_address,
                'user_type' => 'client',
                'status' =>'inactive',
                'verification_token' => $token,
            ];
            $this->userService->createClientUser($data, $leadId);
            // Run queue automatically
            // Artisan::call('queue:work', [
            //     '--once' => true,
            // ]);
            
            if ($lead) {
                return response()->json([
                    'success' => true,
                    'message' => 'Lead converted into Client!',
                     
                ]);
               // session()->flash('success', 'Lead converted into Client!');
            }
        } 
        catch (\Exception $e) {
            session()->flash('error', 'Unable to handle request!');
        }
    }


    public function updateClientinfo(Request $request, $client_id, $client_case_information_id)
    {
        $rules = [];
        $messages = [];
       
        // Loop through intake fields
        foreach ($request->input('intake_fields', []) as $field) {
            $fieldId = $field['dataId'];
            $caseIntakeField = CaseIntakeField::find($fieldId);
        
            // Validation for "other" type fields
            if ($field['type'] === "other") {
                if ($caseIntakeField && $caseIntakeField->required == 1) {
                    $rules["intake_fields.{$fieldId}.value"] = 'required';

                    $messages["intake_fields.{$fieldId}.value"] = "{$caseIntakeField->label} is required.";
                }
            }
        
            // Validation for "radio" type fields
            elseif ($field['type'] === 'radio') {
                $groupId = $field['dataId'];
                $radioGroupName = "intake_fields.{$fieldId}.value";
                if ($caseIntakeField && $caseIntakeField->required == 1) {
                    $rules[$radioGroupName] = 'required';
                    $messages["intake_fields.{$fieldId}.value"] = "Please select an option for radio input group";
                }
            }
        }
        
        $validator = Validator::make($request->all(), $rules, $messages);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }
        
        $result = $this->clientService->updateClientCaseinfo($request, $client_id, $client_case_information_id);
        
        if (!$result) {
            return response()->json(['success' => false]);
        }
        
        // Fetch the updated data to return
        $clientCaseInfo = ClientCaseInformation::where('id', $client_case_information_id)->first();
        $opposingPartyInfo = OpposingPartyinfo::where('client_case_information_id', $client_case_information_id)->first();

        $updatedData = array_merge(
            $clientCaseInfo ? $clientCaseInfo->toArray() : [],
            $opposingPartyInfo ? $opposingPartyInfo->toArray() : []
        );

        return response()->json([
            'success' => true,
            'message' => 'Client updated successfully',
            'updatedData' => $updatedData
        ]);
    }

    public function clientAppointment(Request $request, $client_case_information_id)
    {
        $rules = [
            'date' => 'required|date',
            'time' => 'required',
            'type' => 'required',
            'attorney' => 'required',
            'location' => 'required',
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }

        $result = $this->clientService->createAppointment($request, $client_case_information_id);

        if (!$result) {

            return response()->json(['success' => false, 'message' => 'Unable to handle request!',]);
        }
        return response()->json(['success' => true, 'message' => 'Client Appointment updated successfully',]);
    }

    public function saveStatus(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'status' => 'required|exists:client_statuses,id', // Ensure the status exists in the statuses table
                'record_id' => 'required|exists:clients,id' // Ensure the record exists in the records table
            ]);

            // Pass the data to the service for updating
            $result = $this->clientService->saveStatus($validatedData['record_id'], $validatedData['status']);

            if ($result) {
                return response()->json(['success' => true, 'message' => 'Status updated successfully!']);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to update status.']);
            }
        } catch (\Exception $e) {
            \Log::error('Error updating status', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);

            return response()->json(['success' => false, 'message' => 'An error occurred while updating the status.']);
        }
    }
}
