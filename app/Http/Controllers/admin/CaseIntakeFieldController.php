<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CaseIntakeField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\CaseTypeFieldService;

class CaseIntakeFieldController extends Controller
{
    protected $CaseTypeFieldService;

    public function __construct(CaseTypeFieldService $CaseTypeFieldService)
    {
        $this->CaseTypeFieldService = $CaseTypeFieldService;
    }

    public function createCaseTypeField(Request $request)
    {
        //dd($request->all());

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
            'caseTypeId'       => 'required|integer',
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
    //dd($rules);
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        $result = $this->CaseTypeFieldService->createCaseTypeField($request);

        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }

        session()->flash('success', 'Custom field saved successfully');
        return response()->json(['success' => true, 'message' => 'Custom field saved successfully']);
    }


    public function updateCaseTypeField(Request $request)
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
            'caseTypeId'         => 'required|integer',
            'placeholder'         => 'nullable|string',
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

        $result = $this->CaseTypeFieldService->updateCaseTypeField($request);

        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        session()->flash('success', 'Custom field updated successfully');
        return response()->json(['success' => true, 'message' => 'Custom field updated successfully']);
    }

    public function deleteCaseTypeField(Request $request)
    {

        $rules = [
            'id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 200);
        }

        $result = $this->CaseTypeFieldService->deleteCaseTypeField($request->id);

        if (!$result) {
            return response()->json(['success' => false, 'message' => 'Unable to handle request']);
        }
        session()->flash('success', 'Custom field deleted successfully');
        return response()->json(['success' => true, 'message' => 'Custom field deleted successfully']);
    }

    public function fetchFieldData($caseId, $fieldId)
    {
        $field = CaseIntakeField::where('case_type', $caseId)->where('id', $fieldId)->orderBy('order_number','ASC')->first();

        if (!$field) {
            return response()->json(['error' => 'Field not found'], 404);
        }

        $possibleOptions = (($field->field_type === 'DROP-DOWN-LIST' || $field->field_type === 'RADIO-BUTTON') && $field->possible_options)
                            ? unserialize($field->possible_options)
                            : [];

        return response()->json([
            'label' => $field->label,
            'description' => $field->description,
            'field_type' => $field->field_type,
            'placeholder' => $field->placeholder,
            'required' => $field->required,
            'visible' => $field->visible,
            'possible_options' => $possibleOptions,
        ]);
    }

    public function saveOrder(Request $request)
    {
        // Validate the sorted IDs
        $request->validate([
            'sortedIDs' => 'required|array',
            'sortedIDs.*' => 'exists:case_intake_fields,id', // Ensure all IDs are valid
        ]);

        // Pass the sorted IDs to the service layer for processing
        $this->CaseTypeFieldService->saveSortedOrder($request->sortedIDs);

        // Return a success response
        return response()->json(['success' => true]);
    }
}
