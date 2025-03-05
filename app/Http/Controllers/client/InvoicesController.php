<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function __construct() {}

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'invoices';
        $this->data['controller'] = 'invoices';
        $this->data['controller_name'] = 'Invoices';
        return view('client.'.$this->data['controller'].'.list')->with($this->data);
    }

}
