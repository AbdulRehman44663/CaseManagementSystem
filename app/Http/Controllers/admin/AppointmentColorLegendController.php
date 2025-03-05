<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AppointmentColorLegend;
use Illuminate\Support\Facades\Validator;
use App\Services\AppointmentColorLegendService;

class AppointmentColorLegendController extends Controller
{
    protected $appointmentColorLegendService;

    public function __construct(AppointmentColorLegendService $appointmentColorLegendService)
    {
        $this->appointmentColorLegendService = $appointmentColorLegendService;
    }
    
    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'appointment_color_legend';
        $this->data['controller_name'] = 'Appointment Color Legend';
        return view('admin.'.$this->data['controller'].'.list')->with($this->data);
    }
    
    public function appointmentColorDatatable(Request $request)
    {
        // Retrieve search and pagination parameters
        $search = $request->input('search'); // Search input
        $start = $request->input('start', 0); // Offset
        $length = $request->input('length', 10); // Limit
        $draw = $request->input('draw'); // DataTables draw count
        // Build the query
        $query = AppointmentColorLegend::query();
        
        // Get total records before applying pagination
        $totalRecords = $query->count();    

        // Apply pagination
        $appoitmentColors = $query->get();

        // Return the response in DataTables format
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords, // Total records
            'recordsFiltered' => $totalRecords, // Total records after filtering
            'data' => $appoitmentColors, // Paginated data
        ]);
    }

    public function createAppointmentColor(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'color' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }
        $result = $this->appointmentColorLegendService->createAppointmentLegend($request);
        
        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'Appointment Color saved successfully']);
    }

    public function editAppointmentColor($appointmentId)
    {
        $appointment = AppointmentColorLegend::find($appointmentId);

        return response()->json([
            'success' => true,
            'data' => $appointment,
        ]);
    }

    public function updateAppointmentColor(Request $request, $appointmentId)
    {
        $rules = [
            'name' => 'required|string',
            'color' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }
        $result = $this->appointmentColorLegendService->updateAppointmentLegend($request, $appointmentId);

        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'Appointment Color updated successfully']);
    }

    public function destroy($appointmentId)
    {
        $result = AppointmentColorLegend::find($appointmentId);
        if($result)
        {
            $result->delete();

            return response()->json([
                'success' => true,
                'message' => 'Appointment Color Legend deleted successfully',
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
