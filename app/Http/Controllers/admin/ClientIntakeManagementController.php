<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CaseIntakeField;
use Illuminate\Http\Request;

class ClientIntakeManagementController extends Controller
{
    public function __construct() {}

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'client_intake_management';
        $this->data['controller_name'] = 'Client Intake Management';
        $this->data['case_types'] = getCaseType();
        return view('admin.' . $this->data['controller'] . '.list')->with($this->data);
    }

    public function clientIntakeFields(Request $request)
    {
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'client_intake_management';
        $this->data['controller_name'] = getCaseType($request->case_id)->name . ' - Client Intake Fields';
        $this->data['fields'] = getCaseTypeFields($request->case_id);
        return view('admin.' . $this->data['controller'] . '.fields')->with($this->data);
    }
    
    
}
