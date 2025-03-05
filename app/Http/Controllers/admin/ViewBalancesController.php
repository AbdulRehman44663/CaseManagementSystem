<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CaseType;
use App\Models\Client;
use App\Models\ClientCaseInformation;
use App\Models\ClientInvoice;
use Illuminate\Http\Request;
use App\Services\ClientInvoiceService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
class ViewBalancesController extends Controller
{
    protected $clientInvoiceService;

    public function __construct(ClientInvoiceService $clientInvoiceService)
    {
        $this->clientInvoiceService = $clientInvoiceService;
    }

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'view_balances';
        $this->data['controller_name'] = 'View Balances';
        return view('admin.'.$this->data['controller'].'.list')->with($this->data);
    }


    public function balancesDatatable(Request $request)
    {

        $draw = $request->input('draw');

        $query = ClientInvoice::query();

        $totalRecords = $query->count();

        $balances =  $query->with('client','caseType')->select('*')->get();

        if($totalRecords<1){
            $client_count = Client::count();
            if($client_count>0){
                $client_id = Client::inRandomOrder()->value('id');
                $invoices= [
                    'client_id' => $client_id,
                    'client_case_information_id' => ClientCaseInformation::inRandomOrder()->where('client_id',$client_id)->value('id'),
                    'case_type_id' => ClientCaseInformation::inRandomOrder()->where('client_id',$client_id)->value('case_type_id'),
                    'invoice_type' => 'Contingency',
                    'status' => 'Paid',
                    'total_fee' => 700,
                    'attorney_percentage' => 20,
                    'amount_to_client' => 560,
                    'is_uncollectible' => 'NO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                DB::table('client_invoices')->insert($invoices);

                $invoices = [
                    'client_id' => $client_id,
                    'client_case_information_id' => ClientCaseInformation::inRandomOrder()->where('client_id',$client_id)->value('id'),
                    'case_type_id' => ClientCaseInformation::inRandomOrder()->where('client_id',$client_id)->value('case_type_id'),
                    'invoice_type' => 'Contingency',
                    'status' => 'Pending',
                    'total_fee' => 1200,
                    'attorney_percentage' => 30,
                    'amount_to_client' => 840,
                    'is_uncollectible' => 'NO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                DB::table('client_invoices')->insert($invoices);
                $invoices = [
                    'client_id' => $client_id,
                    'client_case_information_id' => ClientCaseInformation::inRandomOrder()->where('client_id',$client_id)->value('id'),
                    'case_type_id' => ClientCaseInformation::inRandomOrder()->where('client_id',$client_id)->value('case_type_id'),
                    'invoice_type' => 'Hourly',
                    'attorney_fee' => 500,
                    'filing_fee' => 150,
                    'status' => 'Pending',
                    'total_fee' => 650,
                    'is_uncollectible' => 'NO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                DB::table('client_invoices')->insert($invoices);
                $invoices = [
                    'client_id' => $client_id,
                    'client_case_information_id' => ClientCaseInformation::inRandomOrder()->where('client_id',$client_id)->value('id'),
                    'case_type_id' => ClientCaseInformation::inRandomOrder()->where('client_id',$client_id)->value('case_type_id'),
                    'invoice_type' => 'Hourly',
                    'attorney_fee' => 800,
                    'filing_fee' => 250,
                    'status' => 'Paid',
                    'total_fee' => 1050,
                    'is_uncollectible' => 'NO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                DB::table('client_invoices')->insert($invoices);
                $invoices = [
                    'client_id' => $client_id,
                    'client_case_information_id' => ClientCaseInformation::inRandomOrder()->where('client_id',$client_id)->value('id'),
                    'case_type_id' => ClientCaseInformation::inRandomOrder()->where('client_id',$client_id)->value('case_type_id'),
                    'invoice_type' => 'Flat Fee',
                    'attorney_fee' => 900,
                    'filing_fee' => 300,
                    'status' => 'Unpaid',
                    'total_fee' => 1200,
                    'is_uncollectible' => 'NO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                DB::table('client_invoices')->insert($invoices);
                $invoices = [
                    'client_id' => $client_id,
                    'client_case_information_id' => ClientCaseInformation::inRandomOrder()->where('client_id',$client_id)->value('id'),
                    'case_type_id' => ClientCaseInformation::inRandomOrder()->where('client_id',$client_id)->value('case_type_id'),
                    'invoice_type' => 'Flat Fee',
                    'attorney_fee' => 700,
                    'filing_fee' => 200,
                    'status' => 'Pending',
                    'total_fee' => 900,
                    'is_uncollectible' => 'NO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                DB::table('client_invoices')->insert($invoices);
                $invoices = [
                    'client_id' => $client_id,
                    'client_case_information_id' => ClientCaseInformation::inRandomOrder()->where('client_id',$client_id)->value('id'),
                    'case_type_id' => ClientCaseInformation::inRandomOrder()->where('client_id',$client_id)->value('case_type_id'),
                    'invoice_type' => 'Contingency',
                    'status' => 'Paid',
                    'total_fee' => 1500,
                    'attorney_percentage' => 25,
                    'amount_to_client' => 1125,
                    'is_uncollectible' => 'NO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                DB::table('client_invoices')->insert($invoices);
                $invoices = [
                    'client_id' => $client_id,
                    'client_case_information_id' => ClientCaseInformation::inRandomOrder()->where('client_id',$client_id)->value('id'),
                    'case_type_id' => ClientCaseInformation::inRandomOrder()->where('client_id',$client_id)->value('case_type_id'),
                    'invoice_type' => 'Hourly',
                    'attorney_fee' => 600,
                    'filing_fee' => 250,
                    'status' => 'Paid',
                    'total_fee' => 850,
                    'is_uncollectible' => 'NO',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                DB::table('client_invoices')->insert($invoices);


                $query = ClientInvoice::query();

                $totalRecords = $query->count();

                $balances =  $query->with('client','caseType')->select('*')->get();
            }


        }
        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $balances,

        ]);
    }
}
