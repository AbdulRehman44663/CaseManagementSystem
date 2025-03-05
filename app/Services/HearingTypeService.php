<?php

namespace App\Services;

use App\Models\HearingTypes;
 

class HearingTypeService
{
    public function create($requestData)
    {
        try
        {
            $data = new HearingTypes();
            $data->case_type_id = $requestData['caseTypeId'];
            $data->name = $requestData['name_desc'];
            $data->color = $requestData['color_name'];
            $data->save();
            session()->flash('success', 'Hearing Type saved successfully');
            return true;
        } catch (\Throwable $th) {
            $errorMessage = 'Unable to handle request! Error on line ' . $th->getLine();
            session()->flash('error', $errorMessage);
            return false;
        }
    }

    public function update($requestData, $id)
    {
        try {
            $data = HearingTypes::findOrFail($id);
    
            // Update the fields
            $data->case_type_id = $requestData['caseTypeId'];
            $data->name = $requestData['name_desc'];
            $data->color = $requestData['color_name'];
            $data->save();
            
            session()->flash('success', 'Hearing Type updated successfully');
            return true;
        } catch (\Throwable $th) {
            $errorMessage = $id.'Unable to handle request! Error on line ' . $th->getLine() . ': ' . $th->getMessage();
            session()->flash('error', $errorMessage);
            return false;
        }
    }
    
    public function delete($id)
    {
        try {
            $data = HearingTypes::findOrFail($id);
            $data->delete();
            
            session()->flash('success', 'Hearing Type deleted successfully');
            return true;
        } catch (\Throwable $th) {
            $errorMessage = 'Unable to handle request! Error on line ' . $th->getLine() . ': ' . $th->getMessage();
            session()->flash('error', $errorMessage);
            return false;
        }
    }
} 
     