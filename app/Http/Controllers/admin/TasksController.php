<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Services\TaskService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TasksController extends Controller
{
    protected $taskService;

    // Inject TaskService
    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }
    public function index(Request $request)
    {
        $tab = $request->input('tab', 'pending-assigned-to-me');
        $search = $request->input('search', '');

        $tasks = match ($tab) {
            'pending-assigned-to-me' => Task::with(['assignedUsers', 'assignedBy', 'client'])
                ->whereHas('assignedUsers', fn($query) => $query->where('users.id', Auth::id()))
                ->when($search, fn($query) =>
                    $query->whereHas('client', fn($q) => $q->where('primary_client_name', 'LIKE', "%{$search}%"))
                )
                ->where('completed', 0)
                ->get(),

            'all-pending' => Task::with(['assignedUsers', 'assignedBy', 'client'])
                ->when($search, fn($query) =>
                    $query->whereHas('client', fn($q) => $q->where('primary_client_name', 'LIKE', "%{$search}%"))
                )
                ->where('completed', 0)
                ->get(),

            'completed' => Task::with(['assignedUsers', 'assignedBy', 'client'])
                ->when($search, fn($query) =>
                    $query->whereHas('client', fn($q) => $q->where('primary_client_name', 'LIKE', "%{$search}%"))
                )
                ->where('completed', 1)
                ->get(),
        };
        if ($request->ajax()) {
            $view = view('admin.tasks.partials.tab-content', compact('tasks'))->render();
            return response()->json(['html' => $view]);
        }

        $this->data = [
            'sidebar_active' => 'tasks',
            'controller' => 'tasks',
            'controller_name' => 'Tasks',
            'users' => User::where('user_type', '!=', 'client')->get(),
            'search' => $search,
        ];

        return view('admin.' . $this->data['controller'] . '.list')->with($this->data);
    }



    public function storeOrUpdate(Request $request, $taskId = null)
    {
        // Validate incoming request

        $rules = [
            'client_id' => 'required|exists:clients,id',
            'details' => 'nullable|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'user_ids' => 'required|array', // List of user IDs
            'assigned_by' => 'required|exists:users,id', // ID of the user who assigned the task
            'completed' => 'nullable|boolean',
            'assigned_users' => 'required|array',
        ];

        $messages = [
            'client_id.required' => 'Client selection is required.',
            'client_id.exists' => 'The selected client does not exist in our records.',
            'assigned_users.required' => 'Please select at least one user to assign the task.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }

        $result = $this->taskService->createOrUpdateTask($request, $taskId);

        if ($taskId) {
            return response()->json(['success' => true, 'message' => 'Task updated successfully']);
        } else {
            return response()->json(['success' => true, 'message' => 'Task created successfully']);

        }

    }

    public function getTask($taskId)
    {
        $task = Task::with('users', 'client')->findOrFail($taskId);

        // You may want to format the task's date and time
        $task->date = Carbon::parse($task->date)->format('Y-m-d'); // Example format, adjust as needed
        $task->time = Carbon::parse($task->time)->format('H:i');   // Example format, adjust as needed

        // Return the task and the related users
        return response()->json([
            'task' => $task,
            'users' => $task->users, // All users assigned to this task
        ]);
    }

    public function destroy($taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->delete();
        session()->flash('success', 'Task deleted successfully');
        return response()->json(['success' => 'Task deleted successfully']);
    }

    public function searchClients(Request $request)
    {
        $search = $request->input('search');

        $clients = Client::with('clientCasesInfo.caseType')->where('primary_client_name', 'LIKE', "%{$search}%")
                        ->orderBy('primary_client_name', 'asc')
                        ->get();

        return response()->json(['clients' => $clients]);

    }
}
