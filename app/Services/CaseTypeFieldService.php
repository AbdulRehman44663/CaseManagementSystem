<?php

namespace App\Services;

use App\Models\CaseIntakeField;
use App\Models\CaseType;

class CaseTypeFieldService
{

    public function createCaseTypeField($data)
    {
        try {
            // Calculate the next order number (max + 1)
            $nextOrderNumber = CaseIntakeField::where('case_type', $data['caseTypeId'])
                ->max('order_number') + 1;
    
            $field = new CaseIntakeField();
            $field->label = $data['label'];
            $field->description = $data['description'];
            $field->field_type = $data['field_type'];
            // Serialize the array before saving
            $field->possible_options = serialize($data['possible_options']);
            $field->visible = $data['visible'];
            $field->required = $data['required'];
            $field->case_type = $data['caseTypeId'];
            $field->placeholder = $data['placeholder'];
            $field->order_number = $nextOrderNumber; // Assign the calculated order number
            $field->save();
    
            return true;
        } catch (\Throwable $th) {
            // Log the error for debugging
            \Log::error('Error occurred while creating CaseTypeField', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
                'trace' => $th->getTraceAsString(),
            ]);
    
            return [
                'success' => false,
                'message' => 'Unable to handle request! Error: ' . $th->getMessage(),
            ];
        }
    }
    


    public function updateCaseTypeField($data)
    {
        try {
            $field = CaseIntakeField::find($data['fieldId']);
            if (!$field) {
                throw new \Exception('Field not found!');
            }
            $field->label = $data['label'];
            $field->description = $data['description'];
            $field->field_type = $data['field_type'];
            $field->possible_options =  serialize($data['possible_options']);
            $field->visible = $data['visible'];
            $field->required = $data['required'];
            $field->case_type = $data['caseTypeId'];
            $field->placeholder = $data['placeholder'];
            $field->save();

            return true;
        } catch (\Throwable $th) {
            $errorMessage = 'Unable to handle request! Error: ' . $th->getMessage();
            return false;
        }
    }

    public function deleteCaseTypeField($fieldId)
    {
        try {
            // Find the field by its ID
            $field = CaseIntakeField::find($fieldId);

            if (!$field) {
                throw new \Exception('Field not found!');
            }

            // Delete the field
            $field->delete();

            return true; // Deletion successful
        } catch (\Throwable $th) {
            $errorMessage = 'Unable to delete field! Error: ' . $th->getMessage();
            return false; // Deletion failed
        }
    }

    public function saveSortedOrder(array $sortedIDs)
    {
        try {
            // Iterate over the sorted IDs and update the 'order_number' for each field
            foreach ($sortedIDs as $index => $id) {
                // Update the 'order_number' column for each field based on the sorted order
                CaseIntakeField::where('id', $id)->update([
                    'order_number' => $index + 1  // Assuming you start numbering from 1
                ]);
            }

            return true;  // Successfully updated the order
        } catch (\Throwable $th) {
        
            // Return an error message
            return [
                'success' => false,
                'message' => 'Unable to save sorted order! Error: ' . $th->getMessage(),
            ];
        }
    }
}
