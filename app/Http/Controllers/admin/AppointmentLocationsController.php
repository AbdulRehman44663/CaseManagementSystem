<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\AppointmentLocationsService;
use App\Models\AppointmentLocations;
use Illuminate\Support\Facades\Validator;
use DB;

class AppointmentLocationsController extends Controller
{
    protected $appointmentLocationsService;

    public function __construct(AppointmentLocationsService $appointmentLocationsService)
    {
        $this->appointmentLocationsService = $appointmentLocationsService;
    }

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'appointment_locations';
        $this->data['controller_name'] = 'Appointment Locations';
        return view('admin.'.$this->data['controller'].'.list')->with($this->data); 
    }
    
    public function appointmentLocationsDatatable(Request $request)
    {
        // Retrieve search and pagination parameters
        $search = $request->input('search'); // Search input
        $start = $request->input('start', 0); // Offset
        $length = $request->input('length', 10); // Limit
        $draw = $request->input('draw'); // DataTables draw count
        // Build the query
        $query = AppointmentLocations::query();

        // Get total records before applying pagination
        $totalRecords = $query->count();    

        // Apply pagination
        $appointment = $query->select(DB::raw("concat(address, ', ', suite, ', ', city, ', ', state, ', ', zip_code) as location, id"))->get();

         
        // Return the response in DataTables format
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords, // Total records
            'recordsFiltered' => $totalRecords, // Total records after filtering
            'data' => $appointment, // Paginated data
        ]);
    }

    public function createAppointmentLocations(Request $request)
    {
        $rules = [
            'address' => 'required|string|regex:/^[A-Za-z0-9\s.,#\-\/]{5,100}$/',
            'suite' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|regex:/^\d{4,10}$/', // Allows only digits (4 to 10)
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }

        $result = $this->appointmentLocationsService->create($request);
        if (!$result) {
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => true,'message'=>'Appointment Location created successfuly']);
    }

    public function editAppointmentLocations($appointmentLocationsId)
    {
        $appointmentLocations = AppointmentLocations::find($appointmentLocationsId);

        return response()->json([
            'success' => true,
            'data' => $appointmentLocations,
        ]);
    }

    public function updateAppointmentLocations(Request $request, $appointmentLocationsId)
    {
        $rules = [
            'address' => 'required|string|regex:/^[A-Za-z0-9\s.,#\-\/]{5,100}$/',
            'suite' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip_code' => 'required|regex:/^\d{4,10}$/',
        ];
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }
        $result = $this->appointmentLocationsService->update($request, $appointmentLocationsId);
        
        if (!$result) {
            return response()->json(['success' => false]);
        }
        return response()->json(['success' => true,'message'=>'Appointment Location Updated successfuly']);
    }
    
    public function deleteAppointmentLocations($id)
    {
        $result = AppointmentLocations::find($id);
        if($result)
        {
            $result->delete();

            return response()->json([
                'success' => true,
                'message' => 'Location deleted successfully',
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
