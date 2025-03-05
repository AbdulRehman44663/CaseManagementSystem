<?php

namespace App\Http\Controllers\admin;

use App\Models\Attorney;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AttorneyService;
use Illuminate\Support\Facades\Validator;

class AttorneyManagementController extends Controller
{
    protected $attorneyService;

    public function __construct(AttorneyService $attorneyService)
    {
        $this->attorneyService = $attorneyService;
    }

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'attorney_management';
        $this->data['controller_name'] = 'Attorney Management';
        
        return view('admin.'.$this->data['controller'].'.list')->with($this->data);
    }
 

    public function attorneyManagementDatatable(Request $request)
    {
        // Retrieve search and pagination parameters
        $search = $request->input('search'); // Search input
        $start = $request->input('start', 0); // Offset
        $length = $request->input('length', 10); // Limit
        $draw = $request->input('draw'); // DataTables draw count
        // Build the query
        $query = Attorney::query();
        

        // Get total records before applying pagination
        $totalRecords = $query->count();    

        // Apply pagination
        $attorneys = $query->get();

        // Return the response in DataTables format
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords, // Total records
            'recordsFiltered' => $totalRecords, // Total records after filtering
            'data' => $attorneys, // Paginated data
        ]);
    }

    public function createAttorneyManagement(Request $request)
    {
        $rules = [
            'attorney_name'    => 'required|string',
            'address'          => 'required|string|regex:/^[A-Za-z0-9\s.,#\-\/]{5,100}$/',
            'suite'            => 'required',
            'city_state_zip'   => 'required|string|regex:/^[A-Za-z ]+, [A-Z]{2} \d{5}$/',
            'phone_number'     => 'required|regex:/^\+?[0-9\s\-()]{7,20}$/',
            'email'            => 'required|email',
        ];
        
        $messages = [
            'city_state_zip.regex' => 'The city, state, and ZIP format is invalid. Example: "Los Angeles, CA 90001".',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }

        $result = $this->attorneyService->createAttorney($request);

        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'Attorney saved successfully']);
    }

    public function editAttorneyManagement($attorneyId)
    {
        $attorney = Attorney::find($attorneyId);

        return response()->json([
            'success' => true,
            'data' => $attorney,
        ]);
    }

    public function updateAttorneyManagement(Request $request, $attorneyId)
    {
        $rules = [
            'attorney_name'    => 'required|string',
            'address'          => 'required|string|regex:/^[A-Za-z0-9\s.,#\-\/]{5,100}$/',
            'suite'            => 'required',
            'city_state_zip'   => 'required|string|regex:/^[A-Za-z ]+, [A-Z]{2} \d{5}$/',
            'phone_number'     => 'required|regex:/^\+?[0-9\s\-()]{7,20}$/',
            'email'            => 'required',
        ];
  
        $messages = [
            'city_state_zip.regex' => 'The city, state, and ZIP format is invalid. Example: "Los Angeles, CA 90001".',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }
        $result = $this->attorneyService->updateAttorney($request, $attorneyId);
        
        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'Attorney updated successfully']);
    }

    
    public function destroy($id)
    {
        $result = Attorney::find($id);
        if($result)
        {
            $result->delete();

            return response()->json([
                'success' => true,
                'message' => 'Attorney deleted successfully',
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
