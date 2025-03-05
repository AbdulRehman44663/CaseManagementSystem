<?php

namespace App\Http\Controllers\admin;

use App\Models\Client;
use App\Models\HearingTypes;
use Illuminate\Http\Request;
use App\Models\ClientAppointment;
use App\Http\Controllers\Controller;
use App\Models\AppointmentColorLegend;
use App\Models\AppointmentLocations;
use App\Models\Attorney;
use App\Models\CustomEvent;
use App\Services\CalendarService;
use Illuminate\Support\Facades\Validator;

class CalendarController extends Controller
{
    protected $calendarService;

    public function __construct(CalendarService $calendarService)
    {
        $this->calendarService = $calendarService;
    }

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'calendar';
        $this->data['controller'] = 'calendar';
        $this->data['controller_name'] = 'Calendar';
        $this->data['appointment_color_legends'] = AppointmentColorLegend::all();
        $this->data['hearing_types'] = HearingTypes::with('caseType')->get()->groupBy(function ($hearingType) {
            return $hearingType->caseType->name;
        });
        $this->data['clients'] = Client::all();

        $this->data['attorneys'] = Attorney::all();
        $this->data['appointment_locations'] = AppointmentLocations::all();

        
        return view('admin.'.$this->data['controller'].'.list')->with($this->data);
    }

    public function appointmentEvents()
    {
        $this->data['clientAppointments'] = ClientAppointment::with('attorney', 'appointmentColorLegend', 'appointmentLocation', 'clientCaseinformation.client', 'clientCaseinformation.caseType')
        ->get()
        ->map(function ($appointment) {
            $appointment->source_model = 'appointment'; // Add source identifier
            return $appointment;
        });

        $this->data['customEvents'] = CustomEvent::with('client.clientCaseInfo.caseType')
        ->get()
        ->map(function ($event) {
            $event->source_model = 'custom-event'; // Add source identifier
            return $event;
        });
        
           
        if($this->data)
        {
            return response()->json([
                'success' => true,
                'data' => $this->data,
            ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'data' => ''
            ]);
        }
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'subject' =>'required',
            'date' =>'required',
            'time' =>'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }
        $result = $this->calendarService->createEvent($request);
        
        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'Custom event created successfully']);
    }

    public function updateAppointmentEvent(Request $request, $id)
    {
        $rules = [
            'time' => 'required|string',
            'type' =>'required',
            'attorney' =>'required',
            'location' =>'required',
            'status' =>'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }
        $result = $this->calendarService->updateCalendarAppointmentEvent($request, $id);
        
        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'Event updated successfully']);
    }

    public function updateCustomEvent(Request $request, $id)
    {
        $rules = [
            'subject' => 'required|string',
            'time' =>'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }
        $result = $this->calendarService->updateCalendarCustomEvent($request, $id);
        
        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'Event updated successfully']);
    }

    public function appointmentDestroy($id)
    {
        $result = ClientAppointment::find($id);
        if($result)
        {
            $result->delete();

            return response()->json([
                'success' => true,
                'message' => 'Event deleted successfully',
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

    public function customDestroy($id)
    {
        $result = CustomEvent::find($id);
        if($result)
        {
            $result->delete();

            return response()->json([
                'success' => true,
                'message' => 'Event deleted successfully',
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

    public function monthlyAgenda(Request $request)
    {
        $month = $request->month+1;
        $clientAppointments = ClientAppointment::with([
            'attorney', 
            'appointmentColorLegend', 
            'appointmentLocation', 
            'clientCaseinformation.client', 
            'clientCaseinformation.caseType'
        ]);
        
        // Apply the date filter only if year and month are not empty
        if (!empty($request->year) && !empty($month)) {
            $clientAppointments->whereYear('date', $request->year)
                  ->whereMonth('date', $month);
        }
        if (!empty($request->date)) {
            $clientAppointments->where('date', $request->date);
        }
        
        $clientAppointments = $clientAppointments->get()->map(function ($appointment) {
            $appointment->source_model = 'appointment'; // Add source identifier
            return $appointment;
        });


        $customEvents = CustomEvent::with('client.clientCaseInfo.caseType');

        // Apply the date filter only if `year` and `month` are provided
        if (!empty($request->year) && !empty($month)) {
            $customEvents->whereYear('date', $request->year)
                  ->whereMonth('date', $month);
        }
        if (!empty($request->date)) {
            $customEvents->where('date', $request->date);
        }
        
        $customEvents = $customEvents->get()->map(function ($event) {
            $event->source_model = 'custom-event'; // Add source identifier
            return $event;
        });
        
        $events = $customEvents->merge($clientAppointments);

        $sortedEvents = $events->sortBy(function ($event) {
            return $event->date;
        })->values();
        
        $this->data['events'] = $sortedEvents;
         
           
        if($this->data)
        {
            return response()->json([
                'success' => true,
                'data' => $this->data,
            ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'data' => ''
            ]);
        }
    }
}
