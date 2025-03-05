<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LawPayAccountOptionsController extends Controller
{
    public function __construct() {}

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'lawpay_account_options';
        $this->data['controller_name'] = 'LawPay Account Options';
        return view('admin.'.$this->data['controller'].'.list')->with($this->data);
    }
    public function form(Request $request)
    {
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'lawpay_account_options';
        $this->data['controller_name'] = 'LawPay Account Options';
        return view('admin.'.$this->data['controller'].'.form')->with($this->data);
    }
}
