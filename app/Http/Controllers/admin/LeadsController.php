<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Lead;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LeadStatus;
use App\Models\CaseType;
use App\Services\ClientService;
use Illuminate\Support\Facades\Validator;

class LeadsController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'leads';
        $this->data['controller'] = 'leads';
        $this->data['controller_name'] = 'Leads';
        return view('admin.' . $this->data['controller'] . '.list')->with($this->data);
    }

    public function clientsRetained(Request $request)
    {
        $this->data['sidebar_active'] = 'leads';
        $this->data['controller'] = 'leads';
        $this->data['controller_name'] = 'Clients Retained';
        return view('admin.' . $this->data['controller'] . '.clients_retained')->with($this->data);
    }

    public function totalOfLeadsNotRetained(Request $request)
    {
        $this->data['sidebar_active'] = 'leads';
        $this->data['controller'] = 'leads';
        $this->data['controller_name'] = 'Total of Leads Not Retained';
        return view('admin.' . $this->data['controller'] . '.total_of_leads_not_retained')->with($this->data);
    }

    public function totalOfDeadLeads(Request $request)
    {
        $this->data['sidebar_active'] = 'leads';
        $this->data['controller'] = 'leads';
        $this->data['controller_name'] = 'Total of Dead Leads';
        return view('admin.' . $this->data['controller'] . '.total_of_dead_leads')->with($this->data);
    }

    public function add(Request $request)
    {
        $this->data['sidebar_active'] = 'leads';
        $this->data['controller'] = 'leads';
        $this->data['controller_name'] = 'Add New Lead/Client';
        $this->data['case_types'] = getCaseType();
        $this->data['lead_sources'] = getLeadSources();
        $this->data['ad_placements'] = getADPlacement();

        return view('admin.' . $this->data['controller'] . '.add')->with($this->data);
    }

    public function redirectOnLead(Request $request)
    {
        $this->data['sidebar_active'] = 'leads';
        $this->data['controller'] = 'leads';
        $this->data['controller_name'] = 'Add New Lead/Client';
        $this->data['case_types'] = CaseType::where('id', $request->case_type)->get();
        $this->data['client_record'] = Client::find($request->client_id);
        $this->data['lead_sources'] = getLeadSources();
        $this->data['ad_placements'] = getADPlacement();

        return view('admin.' . $this->data['controller'] . '.add')->with($this->data);
    }

    public function getLeadsData(Request $request)
    {
        // Retrieve search and pagination parameters
        $search = $request->input('search'); // Search input
        $start = $request->input('start', 0); // Offset
        $length = $request->input('length', 10); // Limit
        $draw = $request->input('draw'); // DataTables draw count
        // Build the query
        //$query = Client::query();
        $query = Client::with('clientCaseInfo')
        ->whereHas('clientCaseInfo', function ($query) {
            $query->whereNull('parent_id');
        });

        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = Carbon::createFromFormat('m/d/Y', $request->input('start_date'))->startOfDay();
            $endDate = Carbon::createFromFormat('m/d/Y', $request->input('end_date'))->endOfDay();

            // Filter records between the start and end date
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        // Apply search filter if provided
        // if (!empty($search)) {
        //     $query->where(function ($q) use ($search) {
        //         $q->where('primary_client_name', 'LIKE', '%' . $search . '%')
        //             ->orWhere('property_address', 'LIKE', '%' . $search . '%')
        //             ->orWhere('telephone_number', 'LIKE', '%' . $search . '%');
        //     });
        // }

        $query->where('type', 'lead');

        // Get total records before applying pagination
        $totalRecords = $query->count();

        // Apply pagination
        $leads = $query->skip($start)->take($length)->get();



        // Return the response in DataTables format
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords, // Total records
            'recordsFiltered' => $totalRecords, // Total records after filtering
            'data' => $leads, // Paginated data
        ]);
    }

    public function getLeads(Request $request)
    {
        // Get all statuses
        $statuses = LeadStatus::select('id', 'name')->get();

        // Get leads grouped by status
        $leads = Client::with('clientCaseInfo.caseType','leadStatus')->where('type', 'lead')
            ->get()
            ->groupBy(function ($client) {
                return $client->leadStatus ? $client->leadStatus->name : 'Unknown';
            });

        // Combine statuses and leads
        $response = $statuses->mapWithKeys(function ($status) use ($leads) {
            return [$status->name => $leads->get($status->name, [])];
        });

        return response()->json($response);
    }




    public function store(Request $request)
    {
        $rules = [
            'primary_client_name' => 'required|string|max:255',
            'property_address' => 'nullable|string|max:255',
            'telephone_number' => 'nullable|string|max:20|regex:/^\+?[0-9\s\-()]{7,20}$/',
            'alt_phone' => 'nullable|string|max:20|regex:/^\+?[0-9\s\-()]{7,20}$/',
            'email_address' => 'required|email|max:255',
            'drivers_license_no' => 'nullable|string|min:5|max:20|regex:/^[A-Za-z0-9\-]+$/',
            'ssn' => 'nullable|string|max:11|regex:/^\d{3}-\d{2}-\d{4}$/',
            'date_of_birth' => 'nullable|date',
            'marital_status' => 'nullable|string|max:50|regex:/^[a-zA-Z]+$/',
            'other_notes' => 'nullable|string',

            'secondary_client_name' => 'nullable|string|max:255',
            'secondary_telephone_number' => 'nullable|string|max:20|regex:/^\+?[0-9\s\-()]{7,20}$/',
            'secondary_email_address' => 'nullable|email|max:255',
            'secondary_drivers_license_no' => 'nullable|string|min:5|max:20|regex:/^[A-Za-z0-9\-]+$/',
            'secondary_ssn' => 'nullable|string|max:20',
            'secondary_date_of_birth' => 'nullable|date',
            'case_type' => 'required',
            'city' => 'nullable|string|max:100|regex:/^[a-zA-Z]+$/',
            'case_notes' => 'nullable|nullable|string',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }

        $result = $this->clientService->createLead($request);
        if (!$result) {
            return response()->json(['success' => false]);
        }


        if (is_array($result)) {
            return response()->json([
                'success' => true,
                'message' => 'Lead saved successfully',
                'data' => [
                    'client_id' => $result[0],
                    'case_info_id' => $result[1],
                ],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Lead saved successfully',
        ]);
    }



    public function edit($id)
    {
        // Fetch the lead data
        $lead = Client::findOrFail($id);
        $this->data['sidebar_active'] = 'leads';
        $this->data['controller'] = 'leads';
        $this->data['controller_name'] = 'Leads';
        $this->data['lead'] = $lead;
        // Pass the data to the view
        return view('admin.leads.edit', $this->data);
    }

    // app/Http/Controllers/LeadController.php

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'primary_client_name' => 'required|string|max:255',
            'property_address' => 'nullable|string|max:255',
            'telephone_number' => 'nullable|string|max:20',  // Adjust max length as needed
            'alt_phone' => 'nullable|string|max:20',  // Optional field, adjust as needed
            'email_address' => 'nullable|email|max:255',
            'drivers_license_no' => 'nullable|string|max:50',
            'ssn' => 'nullable|string|max:20',  // Adjust length based on your format
            'date_of_birth' => 'nullable|date',  // Should be in the format YYYY-MM-DD
            'marital_status' => 'nullable|string|max:50',  // Adjust max length as needed
            'other_notes' => 'nullable|string',  // Optional field, adjust as needed

            'secondary_client_name' => 'nullable|string|max:255',
            'secondary_telephone_number' => 'nullable|string|max:20',
            'secondary_email_address' => 'nullable|email|max:255',
            'secondary_drivers_license_no' => 'nullable|string|max:50',
            'secondary_ssn' => 'nullable|string|max:20',

            'case_type' => 'nullable|string|max:100',  // Adjust max length as needed
            'hear_about_us' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',  // Adjust max length as needed
            'area' => 'nullable|string|max:100',  // Optional field, adjust as needed

            'case_notes' => 'nullable|nullable|string',  // Optional, if not required
        ]);

        // Find the lead record and update it
        $lead = Client::findOrFail($id);
        $lead->updateLead($validatedData);
        // Redirect with a success message
        return response()->json([
            'success' => true,
            'redirect_url' => route('admin.leads') // Return the URL to redirect to
        ]);
    }

    public function getLeadsStatus($id)
    {
        // Load the lead with the updated relationship
        $lead = Client::with(['clientCaseInfo.caseType', 'leadStatus', 'leadConversations'])->find($id);
        if (!$lead) {
            return response()->json(['message' => 'Lead not found'], 404);
        }

        return response()->json([
            'lead' => $lead,
            'statuses' => LeadStatus::all(),
            'conversationLogs' => $lead->leadConversations, // Fetch all related conversations
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'status' => 'required|exists:lead_statuses,id', // Ensure status exists in the lead_statuses table
        ]);

        // Find the lead by ID
        $lead = Client::find($id);

        if (!$lead) {
            return response()->json(['message' => 'Lead not found'], 404);
        }

        // Update the status of the lead
        $lead->lead_status_id = $request->input('status');
        $lead->save();

        return response()->json(['message' => 'Lead status updated successfully']);
    }

}
