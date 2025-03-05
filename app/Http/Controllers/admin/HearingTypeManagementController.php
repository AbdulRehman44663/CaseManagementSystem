<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Services\HearingTypeService;
use Illuminate\Http\Request;
use App\Models\CaseType;
use App\Models\HearingTypes;
use Illuminate\Support\Facades\Validator;

class HearingTypeManagementController extends Controller
{   
    protected $hearingTypeService;

    public function __construct(HearingTypeService $hearingTypeService)
    {
        $this->hearingTypeService = $hearingTypeService;
    }

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'hearing_type_management';
        $this->data['controller_name'] = 'Hearing Type Management';
        $this->data['case_types'] = CaseType::all();
        return view('admin.'.$this->data['controller'].'.list')->with($this->data);
    }

    public function hearingTypes(Request $request)
    {
        $case_type = CaseType::where('id',$request->id)->first();
        if($case_type){
            $this->data['sidebar_active'] = 'admin_panel';
            $this->data['controller'] = 'hearing_type_management';
            $this->data['controller_name'] = $case_type->name;
            $this->data['case_type'] = $case_type;
            return view('admin.'.$this->data['controller'].'.hearing_types')->with($this->data);
        }else{
            return redirect(route('admin.hearingTypeManagement'))->withError('Invalid case type');
        }
    }

    public function hearingTypesDatatable(Request $request)
    {
        $case_type_id = $request->id;

        // Retrieve search and pagination parameters
        $search = $request->input('search'); // Search input
        $start = $request->input('start', 0); // Offset
        $length = $request->input('length', 10); // Limit
        $draw = $request->input('draw'); // DataTables draw count
        // Build the query
        $query = HearingTypes::query();
        

        // Get total records before applying pagination
        $totalRecords = $query->where('case_type_id',$case_type_id)->count();    

        // Apply pagination
        $leads = $query->select('*')->where('case_type_id',$case_type_id)->get();

        // Return the response in DataTables format
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords, // Total records
            'recordsFiltered' => $totalRecords, // Total records after filtering
            'data' => $leads, // Paginated data
        ]);
    }

    public function createHearingTypes(Request $request)
    {
        $rules = [
            'name_desc' => 'required|string',
            'color_name' => 'required|string',
            'caseTypeId' => 'string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }

        $result = $this->hearingTypeService->create($request);
        if (!$result) {
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => true,'message'=>'Hearing Type created successfuly']);
    }

    public function editHearingTypes($hearingTypesId)
    {
        $hearingTypes = HearingTypes::find($hearingTypesId);

        return response()->json([
            'success' => true,
            'data' => $hearingTypes,
        ]);
    }

    public function updateHearingTypes(Request $request)
    {
        $rules = [
            'name_desc' => 'required|string',
            'color_name' => 'required|string',
            'caseTypeId' => 'string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }
        $result = $this->hearingTypeService->update($request, $request->hearingTypeId);
        
        if (!$result) {
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => true,'message'=>'Hearing Type Updated successfuly']);
    }

     

    public function deleteHearingTypes($id)
    {
        $result = HearingTypes::find($id);
        if($result)
        {
            $result->delete();

            return response()->json([
                'success' => true,
                'message' => 'Hearing type deleted successfully',
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
