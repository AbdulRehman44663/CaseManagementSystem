<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\ClientLog;
use App\Models\ClientTask;
use App\Models\ClientEmail;
use Illuminate\Http\Request;
use App\Jobs\SendClientEmail;
use App\Models\ClientDocument;
use App\Services\ClientService;
use App\Http\Controllers\Controller;
use App\Models\ClientInvoice;
use Illuminate\Support\Facades\Validator;

class ClientsDetailController extends Controller
{
    protected $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function uploadClientDocument(Request $request, $client_case_information_id)
    {
        $validator = Validator::make($request->all(), [
            'documents.*' => 'required|file|max:7168|mimes:tiff,tif,pdf,jpeg,gif,doc,xls,docx,xlsx',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 422);
        }
        $result = $this->clientService->uploadClientDoc($request, $client_case_information_id);
        if($result)
        {
            return response()->json([
                'success' => true,
                'message' => 'Documents update successfully',
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

    public function clientDocumentsDataTable(Request $request, $client_case_information_id)
    {
        $start = $request->input('start', 0); // Offset
        $length = $request->input('length', 10); // Limit
        $draw = $request->input('draw'); // DataTables draw count
        // Build the query
        $query = ClientDocument::query();
        $query = $query->where('client_case_information_id', $client_case_information_id);

        $totalRecords = $query->count();

        // Apply pagination
        $documents = $query->skip($start)->take($length)->get();
        $documents = $documents->map(function ($document) {
            // Assuming you store files in 'public/storage' directory

            $document->path = asset('storage/' . $document->path);  // Make sure to adjust path as per your storage setup
            return $document;
        });

        // Return the response in DataTables format
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords, // Total records
            'recordsFiltered' => $totalRecords, // Total records after filtering
            'data' => $documents, // Paginated data
        ]);
    }

    public function destroy($id)
    {
        $result = ClientDocument::find($id);
        if($result)
        {
            $result->delete();

            return response()->json([
                'success' => true,
                'message' => 'Documents deleted successfully',
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

    public function logsindex($client_case_information_id)
    {
        $client_logs = ClientLog::where('client_case_information_id', $client_case_information_id)->paginate(5);

        $view = view('admin.components.client-logs', compact('client_logs'))->render();

        return response()->json([
            'client_logs' => $view,
        ]);
    }

    public function createLogs(Request $request)
    {
        $rules = [
            'title'   => 'required|string',
            'comment' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }

        $result = $this->clientService->createClientLogs($request);

        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'Logs created successfully']);
    }

    public function editLog($logId)
    {
        $log = ClientLog::with('user')->where('id', $logId)->first();

        return response()->json([
            'success' => true,
            'data' => $log,
        ]);
    }

    public function updateLogs(Request $request, $log_id)
    {
        $rules = [
            'title'   => 'required|string',
            'comment' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }

        $result = $this->clientService->updateClientLogs($request, $log_id);

        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'Logs updated successfully']);
    }

    public function destroyLogs($id)
    {
        $result = ClientLog::find($id);
        if($result)
        {
            $result->delete();

            return response()->json([
                'success' => true,
                'message' => 'Log deleted successfully',
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

    public function clientTasksDataTable(Request $request, $client_case_information_id)
    {
        $start = $request->input('start', 0); // Offset
        $length = $request->input('length', 10); // Limit
        $draw = $request->input('draw'); // DataTables draw count
        // Build the query
        $query = ClientTask::query();
        $query = $query->where('client_case_information_id', $client_case_information_id);

        $totalRecords = $query->count();

        // Apply pagination
        $tasks = $query->skip($start)->take($length)->get();

        $tasks->transform(function ($task) {
            // Split the 'user_assigned' field by commas and fetch the users
            $userIds = explode(',', $task->user_assigned);

            // Fetch the users with the given IDs
            $users = User::whereIn('id', $userIds)->get();

            // Add the users data to the task object
            $task->users = $users;

            return $task;
        });
        // Return the response in DataTables format
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords, // Total records
            'recordsFiltered' => $totalRecords, // Total records after filtering
            'data' => $tasks, // Paginated data
        ]);
    }

    public function clientInvoicesDataTable(Request $request){

        $draw = $request->input('draw'); // DataTables draw count

        $query = ClientInvoice::query();

        $totalRecords = $query->count();

        $invoices =  $query->with('client','caseType')->select('*')->get();

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $invoices,

        ]);
    }

    public function createClientTasks(Request $request)
    {
        $rules = [
            'details' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }

        $result = $this->clientService->createTasks($request);


        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'Tasks saved successfully']);
    }

    public function editClientTasks($taskId)
    {
        $task = ClientTask::find($taskId);

        $task->date = Carbon::parse($task->date)->format('m/d/Y'); // Transform date
        $task->time = Carbon::parse($task->time)->format('h:i A');  // Transform time

        return response()->json([
            'success' => true,
            'data' => $task,
        ]);
    }

    public function updateClientTasks(Request $request, $taskId)
    {
        $rules = [
            'details' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }

        $result = $this->clientService->updateTasks($request, $taskId);


        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'Tasks updated successfully']);
    }

    public function destroyClientTasks($id)
    {
        $result = ClientTask::find($id);
        if($result)
        {
            $result->delete();

            return response()->json([
                'success' => true,
                'message' => 'Task deleted successfully',
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

    public function markStatusClientTasks($taskId)
    {
        $task = ClientTask::find($taskId);
        $status = $task->status == "incomplete" ? "completed" : "incomplete";

        ClientTask::where('id', $taskId)->update([
            'status' => $status,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Mark as '.ucfirst($status),
        ]);
    }

    public function clientEmailDataTable(Request $request, $client_case_information_id)
    {
        $start = $request->input('start', 0); // Offset
        $length = $request->input('length', 10); // Limit
        $draw = $request->input('draw'); // DataTables draw count
        // Build the query
        $query = ClientEmail::query();
        $query = $query->where('client_case_information_id', $client_case_information_id);

        $totalRecords = $query->count();

        // Apply pagination
        $emails = $query->skip($start)->take($length)->get();


        // Return the response in DataTables format
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords, // Total records
            'recordsFiltered' => $totalRecords, // Total records after filtering
            'data' => $emails, // Paginated data
        ]);
    }

    public function createClientEmails(Request $request)
    {
        $rules = [
            'subject'    => 'required|string',
            'from'       => 'required|email',
            'to'         => 'required|email',
            'email_body' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }

        $result = $this->clientService->createEmails($request);

        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'Email send successfully']);
    }

    public function viewClientEmails($emailid)
    {
        $email = ClientEmail::find($emailid);
        if($email)
        {
            $attachments = $email->emailFiles()->get();

            // Prepend the public path for each attachment
            foreach ($attachments as $attachment) {
                $attachment->url = asset('storage/' . $attachment->file_path); // Adjust if the files are in 'storage/app/public'
            }

            $email->attachments = $attachments;
        }

        return response()->json([
            'success' => true,
            'data' => $email,
        ]);
    }

    public function resendClientEmails(Request $request)
    {
        $email = ClientEmail::with('emailFiles')->where('id', $request->client_email_id)->first();

        $filePaths = [];
        foreach($email->emailFiles as $emailFile)
        {
            $filePaths[] = storage_path("app/public/$emailFile->file_path");
        }

       // resend email.
        SendClientEmail::dispatch($email->body, $filePaths, $email->from, $email->to, $email->subject, $email);
        return response()->json(['success' => true, 'message' => 'Email re-send successfully']);

    }
}
