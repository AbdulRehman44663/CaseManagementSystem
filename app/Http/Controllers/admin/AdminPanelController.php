<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPanelController extends Controller
{
    public function __construct() {}

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'admin_panel';
        $this->data['controller_name'] = 'Admin Panel';
        return view('admin.'.$this->data['controller'].'.list')->with($this->data);
    }
}
