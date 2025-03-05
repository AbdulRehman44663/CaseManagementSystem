<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CaseType;
use App\Models\EmailTemplates;
use App\Models\EmailVariable;
use App\Services\EmailTemplateService;
use Illuminate\Support\Facades\Validator;

class EmailTemplateManagementController extends Controller
{
    protected $emailTemplateService;

    public function __construct(EmailTemplateService $emailTemplateService)
    {
        $this->emailTemplateService = $emailTemplateService;
    }

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'email_template_management';
        $this->data['controller_name'] = 'Email Template Management';
        $this->data['case_types'] = CaseType::all();
        $this->data['email_variables'] = EmailVariable::where('variable_type', '!=', 'lawyer')->get();
        $this->data['email_lawyer_variables'] = EmailVariable::where('variable_type', 'lawyer')->get();
       return view('admin.'.$this->data['controller'].'.list')->with($this->data);
    }

    public function emailTemplate(Request $request)
    {
        $case_type = CaseType::where('id',$request->id)->first();
        if($case_type){
            $this->data['sidebar_active'] = 'admin_panel';
            $this->data['controller'] = 'email_template_management';
            $this->data['controller_name'] = $case_type->name.' - Email Template';
            $this->data['case_type'] = $case_type;
            $this->data['email_variables'] = EmailVariable::where('variable_type', '!=', 'lawyer')->get();
            $this->data['email_lawyer_variables'] = EmailVariable::where('variable_type', 'lawyer')->get();
            return view('admin.'.$this->data['controller'].'.email_template')->with($this->data);
        }else{
            return redirect(route('admin.emailTemplateManagement'))->withError('Invalid case type');
        }
    }


    public function emailTemplateDatatable(Request $request)
    {
        $case_type_id = $request->id;
        $draw = $request->input('draw'); // DataTables draw count
        // Build the query
        $query = EmailTemplates::query();
        
        // Get total records before applying pagination
        $totalRecords = $query->where('case_type_id',$case_type_id)->count();    

        // Apply pagination
        $leads = $query->select('*')->where('case_type_id',$case_type_id)->get();
       // dd($leads);
        // Return the response in DataTables format
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords, // Total records
            'recordsFiltered' => $totalRecords, // Total records after filtering
            'data' => $leads, // Paginated data
        ]);
    }

    public function createEmailTemplate(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'subject' => 'required|string',
            'email_body' => ['required',
                function ($attribute, $value, $fail) {
                    if (trim(strip_tags($value)) == '') {
                        $fail('The email body field is required.');
                    }
                },
            ],
            'caseTypeId' => 'string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }

        $result = $this->emailTemplateService->create($request);
        if (!$result) {
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => true,'message'=>'Email Tempalte created successfuly']);
    }

    public function editEmailTemplate($emailTempalteId)
    {
        $data = EmailTemplates::find($emailTempalteId);

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function updateEmailTemplate(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'subject' => 'required|string',
            'email_body' => ['required',
                function ($attribute, $value, $fail) {
                    if (trim(strip_tags($value)) == '') {
                        $fail('The email body field is required.');
                    }
                },
            ],
            'caseTypeId' => 'string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }
        $result = $this->emailTemplateService->update($request, $request->emailTempalteId);
        
        if (!$result) {
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => true,'message'=>'Email Tempalte Updated successfuly']);
    }

    public function deleteEmailTemplate(Request $request, $emailTempalteId)
    {
        $result = $this->emailTemplateService->delete($emailTempalteId);
        
        if (!$result) {
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => true,'message'=>'Email Tempalte deleted successfuly']);
    }

}
