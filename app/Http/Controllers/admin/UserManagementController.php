<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\CaseType;
use App\Models\UserEvent;
use App\Models\UserAccess;
use Illuminate\Http\Request;
use App\Services\UserService;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Models\LawyerAgencyUserType;
use Illuminate\Support\Facades\Validator;

class UserManagementController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $this->data['sidebar_active']     = 'admin_panel';
        $this->data['controller']         = 'user_management';
        $this->data['controller_name']    = 'User Management';
        $this->data['lawyer_user_types']  = LawyerAgencyUserType::all();
        $this->data['case_types']         = CaseType::all();
        return view('admin.'.$this->data['controller'].'.list')->with($this->data);
    }

    public function userDatatable(Request $request)
    {
        $draw = $request->input('draw'); // DataTables draw count
        // Build the query
        $query = User::with('lawyerUserType')->where('user_type', '!=', 'client'); 
        
        // Get total records before applying pagination
        $totalRecords = $query->count();    

        // Apply pagination
        $users = $query->get();
        // Return the response in DataTables format
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords, // Total records
            'recordsFiltered' => $totalRecords, // Total records after filtering
            'data' => $users, // Paginated data
        ]);
    }


    public function createUser(Request $request)
    {
        $rules = [
            'name'         => 'required|string|min:2|regex:/^[a-zA-Z\s]+$/',
            'email'        => 'required|email|unique:users,email',
            'hourly_rate'  => 'required',
            'user_type'    =>'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }
        $result = $this->userService->createLawyerUser($request);
        
        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'User saved successfully']);
    }

    public function editUser($id)
    {
        $user = User::find($id);
        return response()->json([
            'success' => true,
            'data' => $user,
        ]);
    }

    public function updateUser(Request $request, $userId)
    {
        $rules = [
            'name'         => 'required|string|min:2|regex:/^[a-zA-Z\s]+$/',
            'email'        => ['required','email',Rule::unique('users', 'email')->ignore($userId, 'id'),],
            'hourly_rate'  => 'required',
            'user_type'    =>'required',
        ];
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }

        $result = $this->userService->updateLawyerUser($request, $userId);
         
        
        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'User updated successfully']);
    }

    public function deleteUser($userId)
    {
        $result = User::find($userId);
        if($result)
        {
            $result->delete();

            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully',
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

    public function updateUserStatus($userId)
    {
        $user = User::find($userId);
        if($user->status == "active")
        {
            $user->status = "inactive";
        }
        else
        {
            $user->status = "active";
        }
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User Status successfully updated.',
        ]);
    }

    public function editUserEvent($userId)
    {
        $userEvent = UserEvent::where('user_id', $userId)->first();

        return response()->json([
            'success' => true,
            'data' => [
                'case_type_events' => $userEvent ? $userEvent->case_type_events : null,
                'account_event' => $userEvent ? $userEvent->account_event : null
            ]
        ]);

    }

    public function updateUserEvent(Request $request, $userId)
    {
        $result = $this->userService->setUserEvent($request, $userId);
        
        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'Event updated successfully']);
    }

    public function editUserAccess($userId)
    {
        $userAccess = UserAccess::where('user_id', $userId)->first();

        return response()->json([
            'success' => true,
            'data' => [
                'access_modules' => $userAccess ? $userAccess->access_modules : null,
            ]
        ]);
    }

    public function updateUserAccess(Request $request, $userId)
    {
        $result = $this->userService->setUserAccess($request, $userId);
        
        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'User Access updated successfully']);
    }

    public function updateUserPassword($userId)
    {
        $result = $this->userService->sendResetPasswordEmail($userId);
        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'User Access updated successfully']);
    }
}
