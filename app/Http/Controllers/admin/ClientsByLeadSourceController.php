<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\LeadSources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ClientCaseInformation;

class ClientsByLeadSourceController extends Controller
{
    public function __construct() {}

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'clients_by_lead_source';
        $this->data['controller_name'] = 'Clients by Lead Source';
        //$this->data['lead_sources'] = LeadSources::all();
        //$this->data['lead_sources'] = LeadSources::whereHas('clientLeads')->get();
      
        return view('admin.'.$this->data['controller'].'.list')->with($this->data);
    }

    // public function getClientByLeadSource(Request $request)
    // {
    //     $startMonthYear = $request->input('startMonthYear'); 
    //     $endMonthYear = $request->input('endMonthYear');  
    
    //     if (!$startMonthYear || !$endMonthYear) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Start and end month are required.'
    //         ]);
    //     }

    //     $startMonth = Carbon::parse($startMonthYear)->format('Y-m');  
    //     $endMonth = Carbon::parse($endMonthYear)->format('Y-m');  
        
    //     // Fetch all lead sources
    //     $leadSources = LeadSources::all();
        
    //     // Fetch lead source data within the date range and group by year, month, and lead_source_id
    //     $leadSourceData = ClientCaseInformation::select(
    //             DB::raw('YEAR(created_at) as year'),
    //             DB::raw('MONTH(created_at) as month'),
    //             'lead_source_id',
    //             DB::raw('COUNT(*) as total')
    //         )
    //         ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") BETWEEN ? AND ?', [$startMonth, $endMonth])
    //         ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'), 'lead_source_id')
    //         ->get();
        
    //     // Prepare the data in the desired format
    //     $formattedData = [];
    //     $months = [];
        
    //     $leadSources->each(function ($leadSource) use ($leadSourceData, &$formattedData, &$months) {
    //         // Initialize an empty array for the current lead source
    //         $leadSourceDataForCurrentSource = [];
        
    //         // Iterate over the months and add data for the current lead source
    //         foreach ($leadSourceData as $data) {
    //             if ($data->lead_source_id == $leadSource->id) {
    //                 $monthYear = date('M Y', strtotime($data->year . '-' . $data->month . '-01'));
    //                 $leadSourceDataForCurrentSource[$monthYear] = $data->total;
    //                 $months[] = $monthYear;
    //             }
    //         }
        
    //         // Add zero for months with no data for the current lead source
    //         $months = array_unique($months); // Ensure months are unique
    //         foreach ($months as $month) {
    //             if (!isset($leadSourceDataForCurrentSource[$month])) {
    //                 $leadSourceDataForCurrentSource[$month] = 0;
    //             }
    //         }
       
    //         // Add the formatted data to the final data array
    //         $formattedData[] = [
    //             'lead_source_name' => $leadSource->name,
    //             'data' => array_map(function ($month) use ($leadSourceDataForCurrentSource) {
                   
    //                 return [
    //                     'label' => $month,
    //                     'y' => $leadSourceDataForCurrentSource[$month],
    //                 ];
    //             }, $months),
    //         ];
    //     });
        
        
    //     // Sort the months
    //     $months = array_values(array_unique($months));
        
    //     // Prepare the final response data
    //     $finalData = [];
    //     foreach ($formattedData as $leadSourceData) {
             
            
    //             $finalData[] = [
    //                 'type' => 'column',
    //                 'name' => $leadSourceData['lead_source_name'],
    //                 'showInLegend' => true,
    //                 'dataPoints' => array_map(function ($item) {
    //                     return ['label' => $item['label'], 'y' => $item['y']];
    //                 }, $leadSourceData['data']),
    //             ];
            
            
    //     }
    //     //dd($finalData);
    //     return response()->json([
    //         'success' => true,
    //         'data' => $finalData,
    //     ]);

    //     if ($data->isEmpty()) {
    //         $data = collect([
    //             (object)[
    //                 'label' => 'No Data',
    //                 'clients' => 0,
    //                 'leads' => 0
    //             ]
    //         ]);
    //     }
        
    // }

    public function getClientByLeadSource(Request $request)
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

        // Get all lead sources to display in legend
        $leadSources = LeadSources::select('id', 'name')->get();

        // Fetch lead source data within the date range
        $leadSourceData = ClientCaseInformation::select(
                DB::raw('DATE_FORMAT(created_at, "%Y-%m") as monthYear'),
                'lead_source_id',
                DB::raw('COUNT(*) as total')
            )
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m") BETWEEN ? AND ?', [$startMonth, $endMonth])
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'), 'lead_source_id')
            ->get();

        
        $months = collect($leadSourceData)->pluck('monthYear')->unique()->sort()->values()->all();
 
        $formattedData = [];
        
        foreach ($leadSources as $leadSource) {
            $sourceData = [];

            // Loop through each month and get the count (or zero if no data)
            foreach ($months as $month) {
                $monthData = $leadSourceData->where('lead_source_id', $leadSource->id)
                                            ->where('monthYear', $month)
                                            ->first();

                $sourceData[] = [
                    'label' => date('M Y', strtotime($month . '-01')),
                    'y' => $monthData->total ?? 0,
                ];
            }

            // Always add the lead source to the formatted data, even if empty
            $formattedData[] = [
                'name' => $leadSource->name,
                'dataPoints' => $sourceData ?: [],  // Ensures dataPoints is an empty array if no data
            ];
        }

        // Return response with all lead sources in the legend
        
        return response()->json([
            'success' => true,
            'data' => $formattedData,
            'months' => $months
        ]);
    }
}
