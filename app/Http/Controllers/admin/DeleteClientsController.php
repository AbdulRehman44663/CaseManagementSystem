<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeleteClientsController extends Controller
{
    public function __construct() {}

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'delete_clients';
        $this->data['controller_name'] = 'Delete Clients';
       
        return view('admin.'.$this->data['controller'].'.list')->with($this->data);
    }

    public function clientDatatable(Request $request)
    {
        // Retrieve search and pagination parameters
        $search = $request->input('search_client'); // Search input
        $start = $request->input('start', 0); // Offset
        $length = $request->input('length', 10); // Limit
        $draw = $request->input('draw'); // DataTables draw count
        // Build the query
        $query = Client::query();

        if (!empty($search)) {
           
            $query->where(function ($q) use ($search) {
                $q->where('primary_client_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email_address', 'LIKE', '%' . $search . '%')
                    ->orWhere('telephone_number', 'LIKE', '%' . $search . '%');
            });
        }
        // Get total records before applying pagination
        $totalRecords = $query->count();    

        // Apply pagination
        $adPlacement = $query->get();

        // Return the response in DataTables format
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords, // Total records
            'recordsFiltered' => $totalRecords, // Total records after filtering
            'data' => $adPlacement, // Paginated data
        ]);
    }

    public function destroy($client_id)
    {
        $result = Client::find($client_id);
        if($result)
        {
            if($result->type == "client")
            {
                $user = User::find($result->user_id);
                $user->delete();
            }
            $result->delete();


            return response()->json([
                'success' => true,
                'message' => 'Client deleted successfully',
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
