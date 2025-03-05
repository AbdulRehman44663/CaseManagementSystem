<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct() {}

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'dashboard';
        $this->data['controller'] = 'dashboard';
        $this->data['controller_name'] = 'Dashboard';
        return view('admin.'.$this->data['controller'].'.list')->with($this->data);
    }

    public function courseDeadline(Request $request)
    {
        $this->data['sidebar_active'] = 'dashboard';
        $this->data['controller'] = 'dashboard';
        $this->data['controller_name'] = 'Debtor Education Certificate - Due Dates';
        return view('admin.'.$this->data['controller'].'.course_deadline')->with($this->data);
    }

    public function dashboardTaskDatatable(Request $request)
    {
        // Retrieve search and pagination parameters
        $search = $request->input('search'); // Search input
        $start = $request->input('start', 0); // Offset
        $length = $request->input('length', 10); // Limit
        $draw = $request->input('draw'); // DataTables draw count
        // Build the query
        $user_id = Auth::user()->id;

        $query = Task::with(['assignedUsers', 'assignedBy', 'client'])
        ->where('completed', 0)
        ->whereHas('assignedUsers', function ($q) use ($user_id) {
            $q->where('user_id', $user_id);
        });

        //$query = Task::with('assignedUsers', 'assignedBy', 'client')->where('completed', 0); 

        // Get total records before applying pagination
        $totalRecords = $query->count();    

        // Apply pagination
        $tasks = $query->get();
          

        $tasks->transform(function ($task) {
            $taskDateTime = Carbon::parse($task->date . ' ' . $task->time);
            $currentDateTime = Carbon::now();

            return [
                'client_id' => $task->client_id,
                'client_case_information_id' => $task->client_case_information_id,
                'created_by' => optional($task->assignedBy)->name, // Get assigned user's name
                'assigned_to' => $task->assignedUsers->pluck('name')->implode(', '), // Get all assigned users as a comma-separated string
                'client_name' => optional($task->client)->primary_client_name, // Ensure client relation exists
                'date_time' => $taskDateTime->format('m/d/Y - h:i A'), // Format Date-Time
                'details' => $task->details,
                'clock' => $currentDateTime->greaterThan($taskDateTime) ? 'yes' : 'no', // Compare date-time
            ];
        });


        // Return the response in DataTables format
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords, // Total records
            'recordsFiltered' => $totalRecords, // Total records after filtering
            'data' => $tasks, // Paginated data
        ]);
    }
}
