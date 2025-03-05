<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function __construct() {}

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'calendar';
        $this->data['controller'] = 'calendar';
        $this->data['controller_name'] = 'Calendar';
        return view('client.'.$this->data['controller'].'.list')->with($this->data);
    }

}
