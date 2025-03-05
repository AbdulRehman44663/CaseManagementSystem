<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccountingController extends Controller
{
    public function __construct() {}

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'accounting';
        $this->data['controller'] = 'accounting';
        $this->data['controller_name'] = 'Accounting';
        return view('admin.'.$this->data['controller'].'.list')->with($this->data);
    }
}
