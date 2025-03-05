<?php

namespace App\Http\Controllers\admin;

use App\Models\LeadSources;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\LeadSourcesService;
use Illuminate\Support\Facades\Validator;

class LeadSourcesController extends Controller
{
    protected $leadSourcesService;

    public function __construct(LeadSourcesService $leadSourcesService)
    {
        $this->leadSourcesService = $leadSourcesService;
    }

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'lead_sources';
        $this->data['controller_name'] = 'Lead Sources';
        return view('admin.'.$this->data['controller'].'.list')->with($this->data);
    }

    public function leadSourcesDatatable(Request $request)
    {
        // Retrieve search and pagination parameters
        $search = $request->input('search'); // Search input
        $start = $request->input('start', 0); // Offset
        $length = $request->input('length', 10); // Limit
        $draw = $request->input('draw'); // DataTables draw count
        // Build the query
        $query = LeadSources::withCount('clientLeads'); 
        
        // Get total records before applying pagination
        $totalRecords = $query->count();    

        // Apply pagination
        $leadSources = $query->get();
        //dd($leadSources);

        // Return the response in DataTables format
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords, // Total records
            'recordsFiltered' => $totalRecords, // Total records after filtering
            'data' => $leadSources, // Paginated data
        ]);
    }

    public function createLeadSources(Request $request)
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
        $result = $this->leadSourcesService->createLeadSources($request);

       if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'Lead Sources saved successfully']);
    }

    public function editLeadSources($leadSourcesid)
    {
        $leadSources = LeadSources::find($leadSourcesid);

        return response()->json([
            'success' => true,
            'data' => $leadSources,
        ]);
    }

    public function updateLeadSources(Request $request, $leadSourcesid)
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
        $result = $this->leadSourcesService->updateLeadSources($request, $leadSourcesid);
        
        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'Lead Sources updated successfully']);
    }

    public function deleteLeadSource($leadSourcesid)
    {
        $result = LeadSources::find($leadSourcesid);
        if($result)
        {
            $result->delete();

            return response()->json([
                'success' => true,
                'message' => 'Lead sources deleted successfully',
            ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Unable to handle request! Please try again.', 'Error',
            ]);
        }
    }
}
