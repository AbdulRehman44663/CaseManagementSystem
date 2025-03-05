<?php
namespace App\Services;

use Log;
use App\Models\CustomFieldGroup;
use App\Models\CustomFieldGroupDetail;

class CustomGroupFieldsService
{
    public function createGroup($data)
    {
        try
        {
            $customGroupRecord = CustomFieldGroup::latest()->first();
            if($customGroupRecord)
            {
                $order_number = $customGroupRecord->order_number+1;
            }
            else
            {
                $order_number = 1;
            }

            $fieldGroup = new CustomFieldGroup();
            $fieldGroup->case_type_id  = $data['case_type_id'];
            $fieldGroup->label = $data['label'];
            $fieldGroup->order_number = $order_number;
            $fieldGroup->save();
            return true;

        } catch (\Throwable $th) {
            Log::error('create group fileds error:' . $th->getMessage());
            
            return false;
        }
    }

    public function updateGroup($data, $id)
    {
        try
        {
            $fieldGroup = CustomFieldGroup::find($id);
            $fieldGroup->case_type_id  = $data['case_type_id'];
            $fieldGroup->label = $data['label'];
            $fieldGroup->save();
            return true;

        } catch (\Throwable $th) {
            Log::error('update group fileds error:' . $th->getMessage());
            
            return false;
        }
    }

    public function saveSortedOrder(array $sortedIDs)
    {
        try {
            // Iterate over the sorted IDs and update the 'order_number' for each field
            foreach ($sortedIDs as $index => $id) {
                // Update the 'order_number' column for each field based on the sorted order
                CustomFieldGroup::where('id', $id)->update([
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

    public function createCustomDetailField($data)
    {
        try {
            // Calculate the next order number (max + 1)
            $nextOrderNumber = CustomFieldGroupDetail::where('custom_field_group_id', $data['custom_group_id'])
                ->max('order_number') + 1;
    
            $field = new CustomFieldGroupDetail();
            $field->label = $data['label'];
            $field->description = $data['description'];
            $field->field_type = $data['field_type'];
            // Serialize the array before saving
            $field->possible_options = serialize($data['possible_options']);
            $field->visible = $data['visible'];
            $field->required = $data['required'];
            $field->custom_field_group_id  = $data['custom_group_id'];
            $field->placeholder = $data['placeholder'];
            $field->order_number = $nextOrderNumber; // Assign the calculated order number
            $field->save();
    
            return true;
        } catch (\Throwable $th) {
            // Log the error for debugging
            \Log::error('Error occurred while creating custom group field detail', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
                'trace' => $th->getTraceAsString(),
            ]);
            return false;
        }
    }

    public function updateCustomDetailField($data)
    {
        try {
            $field = CustomFieldGroupDetail::find($data['group_field_id']);
            if (!$field) {
                throw new \Exception('Field not found!');
            }
            $field->label                  = $data['label'];
            $field->description            = $data['description'];
            $field->field_type             = $data['field_type'];
            $field->possible_options       =  serialize($data['possible_options']);
            $field->visible                = $data['visible'];
            $field->required               = $data['required'];
            $field->custom_field_group_id  = $data['custom_group_id'];
            $field->placeholder            = $data['placeholder'];
            $field->save();

            return true;
        } catch (\Throwable $th) {
            $errorMessage = 'Unable to handle request! Error: ' . $th->getMessage();
            return false;
        }
    }

    public function saveDetailFieldSortedOrder(array $sortedIDs)
    {
        try {
            // Iterate over the sorted IDs and update the 'order_number' for each field
            foreach ($sortedIDs as $index => $id) {
                CustomFieldGroupDetail::where('id', $id)->update([
                    'order_number' => $index + 1,
                ]);
            }
            return true;  
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'message' => 'Unable to save sorted order! Error: ' . $th->getMessage(),
            ];
        }
    }
}