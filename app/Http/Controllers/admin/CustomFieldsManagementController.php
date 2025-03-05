<?php

namespace App\Http\Controllers\admin;

use App\Models\CaseType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CustomFieldGroup;
use App\Models\CustomFieldGroupDetail;
use App\Services\CustomGroupFieldsService;
use Illuminate\Support\Facades\Validator;

class CustomFieldsManagementController extends Controller
{
    protected $customGroupFieldsService;

    public function __construct(CustomGroupFieldsService $customGroupFieldsService)
    {
        $this->customGroupFieldsService = $customGroupFieldsService;
    }

    public function index(Request $request)
    {
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'custom_fields_management';
        $this->data['controller_name'] = 'Custom Fields Management';
        $this->data['case_types'] = CaseType::all();
        return view('admin.'.$this->data['controller'].'.list')->with($this->data);
    }

    public function customFields($caseTypeId)
    {
        $this->data['case_type'] = CaseType::find($caseTypeId);
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'custom_fields_management';
        $this->data['controller_name'] =   $this->data['case_type']->name.' - Custom Field Groups';
        $this->data['custom_groups'] = CustomFieldGroup::withCount('customFieldDetail')->where('case_type_id', $caseTypeId)->orderBy('order_number','ASC')->get();
        return view('admin.'.$this->data['controller'].'.custom_fields')->with($this->data);
    }

    public function customFieldsGroup($groupId)
    {
        $this->data['custom_group'] = CustomFieldGroup::find($groupId);
        $this->data['custom_group_details'] = CustomFieldGroupDetail::where('custom_field_group_id', $groupId)->orderBy('order_number','ASC')->get();
        $this->data['case_type'] = CaseType::find($this->data['custom_group']->case_type_id);
        $this->data['sidebar_active'] = 'admin_panel';
        $this->data['controller'] = 'custom_fields_management';
        $this->data['controller_name'] = $this->data['case_type']->name. '-'. $this->data['custom_group']->label;
        return view('admin.'.$this->data['controller'].'.custom_fields_group')->with($this->data);
    }

    public function createCustomGroup(Request $request)
    {
        $rules = [
            'label' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }
        $result = $this->customGroupFieldsService->createGroup($request);
        
        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'Custom group create successfully']);
        
    }

    public function editCustomGroup($groupId)
    {
        $customGroup = CustomFieldGroup::find($groupId);

        return response()->json([
            'success' => true,
            'data' => $customGroup,
        ]);
    }

    public function updateCustomGroup(Request $request, $groupId)
    {
        $rules = [
            'label' => 'required|string',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }
        $result = $this->customGroupFieldsService->updateGroup($request, $groupId);
        
        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'Custom group update successfully']);
    }

    public function destroyCustomgroup($groupId)
    {
        $result = CustomFieldGroup::find($groupId);
        if($result)
        {
            $orderNumber = $result->order_number;
            $result->delete();

             // Decrement order_number for remaining records
            CustomFieldGroup::where('order_number', '>', $orderNumber)
            ->decrement('order_number');
            
            return response()->json([
                'success' => true,
                'message' => 'Group deleted successfully',
            ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Unable to handle request! Please try again.', 'Error',
            ]);
        }
    }

    public function customFieldSaveOrder(Request $request)
    {
        // Validate the sorted IDs
        $request->validate([
            'sortedIDs' => 'required|array',
            'sortedIDs.*' => 'exists:custom_field_groups,id', 
        ]);

        // Pass the sorted IDs to the service layer for processing
        $this->customGroupFieldsService->saveSortedOrder($request->sortedIDs);

        // Return a success response
        return response()->json(['success' => true]);
    }
    
    public function createCustomGroupDetail(Request $request)
    {
        $request->merge([
            'visible' => $request->has('visible') && $request->input('visible') === '1',
            'required' => $request->has('required') && $request->input('required') === '1',
        ]);

        $rules = [
            'label'            => 'required|string',
            'description'      => 'required|string',
            'field_type'       => 'required|string',
            'visible'          => 'required|boolean',
            'required'         => 'required|boolean',
            'custom_group_id'  => 'required|integer',
        ];

        if ($request->input('field_type') === 'DROP-DOWN-LIST' || $request->input('field_type') === 'RADIO-BUTTON') {
            $rules['possible_options'] = [
                'required',
                'array',
                'min:1',
                function ($attribute, $value, $fail) {
                    // Loop through each option in the array
                    foreach ($value as $option) {
                        // Check that each option is a string (you can add more checks if needed)
                        if (!is_string($option)) {
                            return $fail('The possible options field is required.');
                        }
                    }
                }
            ];
        } else {
            $rules['possible_options'] = 'nullable';
        }
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }
        
        $result = $this->customGroupFieldsService->createCustomDetailField($request);

        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }

        return response()->json(['success' => true, 'message' => 'Custom field saved successfully']);
        
    }

    public function editCustomGroupDetail($groupFieldId)
    {
        $field = CustomFieldGroupDetail::find($groupFieldId);

        if (!$field) {
            return response()->json(['error' => 'Field not found'], 404);
        }

        $possibleOptions = (($field->field_type === 'DROP-DOWN-LIST' || $field->field_type === 'RADIO-BUTTON') && $field->possible_options)
                            ? unserialize($field->possible_options)
                            : [];

        return response()->json([
            'id' => $field->id,
            'label' => $field->label,
            'description' => $field->description,
            'field_type' => $field->field_type,
            'placeholder' => $field->placeholder,
            'required' => $field->required,
            'visible' => $field->visible,
            'possible_options' => $possibleOptions,
        ]);
    }

    public function updateCustomGroupDetail(Request $request)
    {
        $request->merge([
            'visible' => $request->has('visible') && $request->input('visible') === '1',
            'required' => $request->has('required') && $request->input('required') === '1',
        ]);
        $rules = [
            'label'            => 'required|string',
            'description'      => 'required|string',
            'field_type'       => 'required|string',
            //'possible_options' => 'nullable',
            'visible'          => 'required|boolean',
            'required'         => 'required|boolean',
            'custom_group_id'  => 'required|integer',
            'placeholder'      => 'nullable|string',
        ];

        if ($request->input('field_type') === 'DROP-DOWN-LIST' || $request->input('field_type') === 'RADIO-BUTTON') {
            $rules['possible_options'] = [
                'required',
                'array',
                'min:1',
                function ($attribute, $value, $fail) {
                    foreach ($value as $option) {
                        if (!is_string($option)) {
                            return $fail('The possible options field is required.');
                        }
                    }
                }
            ];
        } else {
            $rules['possible_options'] = 'nullable';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }
        $result = $this->customGroupFieldsService->updateCustomDetailField($request);
        
        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        return response()->json(['success' => true, 'message' => 'Custom field updated successfully']);
    }

    
    public function destroyCustomgroupDetail($groupDetailId)
    {
        $result = CustomFieldGroupDetail::find($groupDetailId);
        if($result)
        {
            $orderNumber = $result->order_number;
            $result->delete();

             // Decrement order_number for remaining records
             CustomFieldGroupDetail::where('order_number', '>', $orderNumber)
            ->decrement('order_number');
            
            return response()->json([
                'success' => true,
                'message' => 'Field deleted successfully',
            ]);
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Unable to handle request! Please try again.', 'Error',
            ]);
        }
    }

    public function customFieldSaveOrderDetail(Request $request)
    {
        // Validate the sorted IDs
        $request->validate([
            'sortedIDs' => 'required|array',
            'sortedIDs.*' => 'exists:custom_field_group_details,id', 
        ]);

        // Pass the sorted IDs to the service layer for processing
        $this->customGroupFieldsService->saveDetailFieldSortedOrder($request->sortedIDs);

        // Return a success response
        return response()->json(['success' => true]);
    }
}
