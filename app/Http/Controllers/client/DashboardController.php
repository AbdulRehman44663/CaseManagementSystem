<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct() {}

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'dashboard';
        $this->data['controller'] = 'dashboard';
        $this->data['controller_name'] = 'Dashboard';
        return view('client.'.$this->data['controller'].'.list')->with($this->data);
    }

}
