<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ClientInvoice;
use Illuminate\Http\Request;
use App\Models\PlanPayment;
use Carbon\Carbon;

class PaymentsCollectedController extends Controller
{
    public function __construct() {}

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'payments_collected';
        $this->data['controller_name'] = 'Payments Collected';
        return view('admin.'.$this->data['controller'].'.list')->with($this->data);
    }

    public function  paymentsDatatable(Request $request){
        $draw = $request->input('draw');

        $query = ClientInvoice::query();

        $totalRecords = $query->whereHas('invoicePayments',function($query){
            $query->where('is_paid','YES');
        })->count();

        $payments =  $query->with([
                    'client',
                    'invoicePayments' ])->whereHas('invoicePayments',function($query) use ($request){
            $query->where('is_paid','YES');
            if ($request->has('start_date') && $request->has('end_date')) {
                $startDate = Carbon::createFromFormat('m/d/Y', $request->input('start_date'))->startOfDay();
                $endDate = Carbon::createFromFormat('m/d/Y', $request->input('end_date'))->endOfDay();

                // Filter records between the start and end date
                $query->whereBetween('payment_date', [$startDate, $endDate]);
            }
        })->select('*')->get();

        if($totalRecords<1){
            $invoice_count = ClientInvoice::count();
            if($invoice_count>0){
                $done = [];
                $client_invoice_id = ClientInvoice::inRandomOrder()->value('id');

                if(!in_array($client_invoice_id , $done)){
                    $client_invoice = ClientInvoice::find($client_invoice_id);

                    $data = [
                        'client_invoice_id' => $client_invoice_id,
                        'payment_number' => 1,
                        'payment_date' => Carbon::now()->subDays(rand(1,35))->format("Y-m-d"),
                        'is_paid' => 'YES',
                        'payment_method' => 'CASH',
                        'payment_amount' => $client_invoice->total_fee,
                        'payment_recieved_by' => 'ADMIN',
                    ];
                    PlanPayment::insert($data);
                    $done[] = $client_invoice_id;
                }

                $client_invoice_id = ClientInvoice::inRandomOrder()->whereNotIn('id',$done)->value('id');

                if(!in_array($client_invoice_id , $done)){

                    $data = [
                        'client_invoice_id' => $client_invoice_id,
                        'payment_number' => 1,
                        'payment_date' => Carbon::now()->subDays(rand(1,35))->format("Y-m-d"),
                        'is_paid' => 'YES',
                        'payment_amount' => $client_invoice->total_fee,
                        'payment_method' => 'CASH',
                        'payment_recieved_by' => 'ADMIN',
                    ];
                    PlanPayment::insert($data);
                    $done[] = $client_invoice_id;
                }

                $query = ClientInvoice::query();

                $totalRecords = $query->whereHas('invoicePayments',function($query){
                    $query->where('is_paid','YES');
                })->count();

                $payments =  $query->with([
                    'client',
                    'invoicePayments'])->whereHas('invoicePayments',function($query) use ($request){
                        $query->where('is_paid','YES');
                        if ($request->has('start_date') && $request->has('end_date')) {
                            $startDate = Carbon::createFromFormat('m/d/Y', $request->input('start_date'))->startOfDay();
                            $endDate = Carbon::createFromFormat('m/d/Y', $request->input('end_date'))->endOfDay();

                            // Filter records between the start and end date
                            $query->whereBetween('payment_date', [$startDate, $endDate]);
                        }
                })->select('*')->get();
            }
        }

        return response()->json([
            'draw' => $draw,
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalRecords,
            'data' => $payments,

        ]);

    }
}
