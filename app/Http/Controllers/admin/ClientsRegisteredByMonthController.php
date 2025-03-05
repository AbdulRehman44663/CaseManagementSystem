<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\LeadSources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ClientsRegisteredByMonthController extends Controller
{
    public function __construct() {}

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'clients_registered_by_month';
        $this->data['controller_name'] = 'Clients registered by month';
        return view('admin.'.$this->data['controller'].'.list')->with($this->data);
    }

    public function getClientLeadDateRange(Request $request)
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
    
        $data = DB::table('clients')
            ->selectRaw('
                DATE_FORMAT(created_at, "%b %Y") as label,
                YEAR(created_at) as year,
                MONTH(created_at) as month,
                SUM(CASE WHEN type = "client" THEN 1 ELSE 0 END) as clients,
                SUM(CASE WHEN type = "lead" THEN 1 ELSE 0 END) as leads
            ')
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") BETWEEN ? AND ?', [$startMonth, $endMonth])
            ->groupBy('year', 'month', 'label')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
            
        // Handle case when no data is found
        if ($data->isEmpty()) {
            $data = collect([
                (object)[
                    'label' => 'No Data',
                    'clients' => 0,
                    'leads' => 0
                ]
            ]);
        }
    
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }   
    
}
