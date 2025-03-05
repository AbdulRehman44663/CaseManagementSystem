<?php

namespace App\Http\Controllers\admin;

use App\Models\ADPlacement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ADPlacementService;
use Illuminate\Support\Facades\Validator;

class ADPlacementController extends Controller
{
    protected $adPlacementService;
    public function __construct(ADPlacementService $adPlacementService)
    {
        $this->adPlacementService = $adPlacementService;
    }

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'ad_placement';
        $this->data['controller_name'] = 'AD Placement';
        return view('admin.'.$this->data['controller'].'.list')->with($this->data);
    }
    
    public function adPlacementDatatable(Request $request)
    {
        // Retrieve search and pagination parameters
        $search = $request->input('search'); // Search input
        $start = $request->input('start', 0); // Offset
        $length = $request->input('length', 10); // Limit
        $draw = $request->input('draw'); // DataTables draw count
        // Build the query
        $query = ADPlacement::withCount('clientAdPlacement'); 
        
        // Get total records before applying pagination
        $totalRecords = $query->count();    

        // Apply pagination
        $adPlacements = $query->get();

        // Return the response in DataTables format
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords, // Total records
            'recordsFiltered' => $totalRecords, // Total records after filtering
            'data' => $adPlacements, // Paginated data
        ]);
    }

    public function createADPlacement(Request $request)
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
        $result = $this->adPlacementService->createAdPlacement($request);
        
        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'AD Placement saved successfully']);
    }

    public function editADPlacement($adPlacementId)
    {
        $adPlacement = ADPlacement::find($adPlacementId);

        return response()->json([
            'success' => true,
            'data' => $adPlacement,
        ]);
    }

    public function updateADPlacement(Request $request, $adPlacementId)
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
        $result = $this->adPlacementService->updateAdPlacement($request, $adPlacementId);

        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'AD Placement updated successfully']);
    }

    
    public function deleteADPlacement($adPlacementId)
    {
        $result = ADPlacement::find($adPlacementId);
        if($result)
        {
            $result->delete();

            return response()->json([
                'success' => true,
                'message' => 'Ad Placement deleted successfully',
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
