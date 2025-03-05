<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommunicationsController extends Controller
{
    public function __construct() {}

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'communications';
        $this->data['controller'] = 'communications';
        $this->data['controller_name'] = 'Communications';
        return view('client.'.$this->data['controller'].'.list')->with($this->data);
    }

}
