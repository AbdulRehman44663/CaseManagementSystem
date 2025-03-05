<?php

namespace App\Http\Controllers\admin;

use App\Models\CaseType;
use App\Models\Variable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DocumentTemplates;
use App\Models\EDocumentVariable;
use App\Services\DocumentTemplateService;
use Illuminate\Support\Facades\Validator;
use League\CommonMark\Node\Block\Document;

class DocumentTemplateManagementController extends Controller
{
    protected $documentTemplateService;

    public function __construct(DocumentTemplateService $documentTemplateService)
    {
        $this->documentTemplateService = $documentTemplateService;
    }

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'document_template_management';
        $this->data['controller_name'] = 'Document Template Management';
        $this->data['case_types'] = CaseType::all();
        $this->data['doc_variables'] = EDocumentVariable::where('variable_type', '!=', 'lawyer')->get();
        $this->data['doc_lawyer_variables'] = EDocumentVariable::where('variable_type', 'lawyer')->get();
        // $this->data['document_variables'] = Variable::whereIn('category', ['Document', 'Both'])->get();
        return view('admin.'.$this->data['controller'].'.list')->with($this->data);
    }

    public function documentTemplate($caseTypeId)
    {
        $this->data['case_type'] = CaseType::find($caseTypeId);
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'document_template_management';
        $this->data['controller_name'] =  $this->data['case_type']->name. '- Document Template ';
        // $this->data['document_variables'] = Variable::whereIn('category', ['Document', 'Both'])->get();
        $this->data['doc_variables'] = EDocumentVariable::where('variable_type', '!=', 'lawyer')->get();
        $this->data['doc_lawyer_variables'] = EDocumentVariable::where('variable_type', 'lawyer')->get();
        return view('admin.'.$this->data['controller'].'.documentTemplate')->with($this->data);
    }

    public function documentTemplateDatatable(Request $request)
    {
        $case_type_id = $request->id;
        $draw = $request->input('draw'); // DataTables draw count
        // Build the query
        $query = DocumentTemplates::query();
        
        // Get total records before applying pagination
        $totalRecords = $query->where('case_type_id',$case_type_id)->count();    

        // Apply pagination
        $document_templates = $query->select('*')->where('case_type_id',$case_type_id)->get();
        
        // Return the response in DataTables format
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords,  
            'recordsFiltered' => $totalRecords,  
            'data' => $document_templates,  
        ]);
    }

    public function createDocumentTemplate(Request $request)
    {
        
         $rules = [
            'template_name' => 'required|string',
            'document_body' => ['required',
                function ($attribute, $value, $fail) {
                    if (trim(strip_tags($value)) == '') {
                        $fail('The document body field is required.');
                    }
                },
            ],
            'caseTypeId' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }

        $result = $this->documentTemplateService->create($request);
        if (!$result) {
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => true,'message'=>'Document Template created successfuly']);
    }

    public function editDocumentTemplate($documentTempalteId)
    {
        $data = DocumentTemplates::find($documentTempalteId);
        
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function updateDocumentTemplate(Request $request, $documentTempalteId)
    {
        $rules = [
            'template_name' => 'required|string',
            'document_body' => ['required',
                function ($attribute, $value, $fail) {
                    if (trim(strip_tags($value)) == '') {
                        $fail('The document body field is required.');
                    }
                },
            ],
            'caseTypeId' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }
        $result = $this->documentTemplateService->update($request, $documentTempalteId);
        
        if (!$result) {
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => true,'message'=>'Document template Updated successfuly']);
    }

    public function deleteDocumentTemplate($documentTempalteId)
    {
        $result = $this->documentTemplateService->delete($documentTempalteId);
        
        if (!$result) {
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => true,'message'=>'Document template deleted successfuly']);
    }
}
