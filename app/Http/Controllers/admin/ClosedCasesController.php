<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClosedCasesController extends Controller
{
    public function __construct() {}

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'dashboard';
        $this->data['controller'] = 'closed_cases';
        $this->data['controller_name'] = 'Closed Cases';
        return view('admin.'.$this->data['controller'].'.list')->with($this->data);
    }
}
