<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class NewClientsByMonthController extends Controller
{
    public function __construct() {}

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'new_clients_by_month';
        $this->data['controller_name'] = 'New Clients by month';
        return view('admin.'.$this->data['controller'].'.list')->with($this->data);
    }

    public function getNewClientByDateRange(Request $request)
    {
        $startMonthYear = $request->input('startMonthYear'); 
        $endMonthYear = $request->input('endMonthYear');  
    
        if (!$startMonthYear || !$endMonthYear) {
            return response()->json([
                'success' => false,
                'message' => 'Start and end month are required.'
            ]);
        }

        $startMonth = Carbon::parse($startMonthYear)->format('Y-m');  
        $endMonth = Carbon::parse($endMonthYear)->format('Y-m');  
        
        // Fetch all records from clients table grouped by month/year
        $data = DB::table('clients')
            ->selectRaw('DATE_FORMAT(created_at, "%b %Y") as label,
                        COUNT(*) as new_clients')
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") BETWEEN ? AND ?', [$startMonth, $endMonth])
            ->where('type', 'client')
            ->groupBy('label')
            ->orderByRaw('MIN(created_at) ASC')
            ->get();
        
        // If no data exists, return default data with 'No Data'
        if ($data->isEmpty()) {
            $data = collect([
                (object)[
                    'label' => 'No Data',
                    'new_clients' => 0
                ]
            ]);
        }
        
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
        
    }
}
