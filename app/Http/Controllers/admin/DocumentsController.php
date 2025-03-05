<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    public function __construct() {}

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'documents';
        $this->data['controller'] = 'documents';
        $this->data['controller_name'] = 'Documents';
        return view('admin.'.$this->data['controller'].'.list')->with($this->data);
    }
}
