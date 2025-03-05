<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Variable;
use Illuminate\Http\Request;
use App\Services\VariableService;

class VariablesController extends Controller
{
    protected $variableService;

    public function __construct(VariableService $variableService)
    {
        $this->variableService = $variableService;
    }

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'variables';
        $this->data['controller'] = 'variables';
        $this->data['controller_name'] = 'Variables';
        return view('admin.' . $this->data['controller'] . '.list')->with($this->data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'variable' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'category' => 'required|in:document,email,both',
        ]);

        $this->variableService->saveVariable($request->all());
        session()->flash('success', 'Variable created successfully');
        return response()->json(['success' => 'Variable created successfully']);
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'variable' => 'required|string|max:255',
            'label' => 'required|string|max:255',
            'category' => 'required|in:document,email,both',
        ]);

        // Call the service to handle the update logic
        $updatedVariable = $this->variableService->updateVariable($id, $request->all());

        if ($updatedVariable) {
            session()->flash('success', 'Variable updated successfully');
            return response()->json(['success' => true, 'message' => 'Variable updated successfully']);
        }
        session()->flash('success', 'Failed to update variable');
        return response()->json(['success' => false, 'message' => 'Failed to update variable'], 500);
    }

    public function getEmailVariables()
    {
        $variables = Variable::whereIn('category', ['Email', 'Both'])->get();
        // dd($variables);
        return response()->json(['success' => true, 'data' => $variables]);
    }

    public function getDocVariables()
    {
        $variables = Variable::whereIn('category', ['Document', 'Both'])->get();
        // dd($variables);
        return response()->json(['success' => true, 'data' => $variables]);
    }
}
