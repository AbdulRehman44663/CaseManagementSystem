<?php

namespace App\Http\Controllers\admin;

use App\Models\CaseType;
use Illuminate\Http\Request;
use App\Services\CaseTypeService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CaseTypeManagementController extends Controller
{
    protected $caseTypeService;

    public function __construct(CaseTypeService $caseTypeService)
    {
        $this->caseTypeService = $caseTypeService;
    }

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'case_type_management';
        $this->data['controller_name'] = 'Case Type Management';
        return view('admin.'.$this->data['controller'].'.list')->with($this->data);
    }

    public function caseTypeDatatable(Request $request)
    {
        $search = $request->input('search'); 
        $start = $request->input('start', 0); 
        $length = $request->input('length', 10); 
        $draw = $request->input('draw'); 
         
       // $query = CaseType::query();
        $query = CaseType::withCount('clientCases'); 
        
        $totalRecords = $query->count();    
         
        // Fetch paginated data with case count
        $caseTypes = $query->get()->map(function ($caseType) {
            // Append message if client_cases_count > 0
            if ($caseType->client_cases_count > 0 && $caseType->custom != "yes") {
                $caseType->name .= " <span class='text-danger'>(This case type is assigned to {$caseType->client_cases_count} client(s), to delete it you need to move the client(s) to another case type.)</span>";
            }
            return $caseType;
        });

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $caseTypes,
        ]);
    }

    public function createCaseType(Request $request)
    {
        $rules = [
            'name' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }

        $result = $this->caseTypeService->createCaseType($request);

        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'Case Type saved successfully']);
       
    }

    public function editCaseType($caseId)
    {
        $caseType = CaseType::find($caseId);

        return response()->json([
            'success' => true,
            'data' => $caseType,
        ]);
    }

    public function updateCaseType(Request $request, $caseId)
    {
        $rules = [
            'name' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }
        $result = $this->caseTypeService->updateCaseType($request, $caseId);

        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'Case Type updated successfully']);
    }

    public function deleteCaseType($id)
    {
        $result = CaseType::find($id);
        if($result)
        {
            $result->delete();

            return response()->json([
                'success' => true,
                'message' => 'Case Type deleted successfully',
            ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Unable to handle request',
            ]);
        }
    }
}
