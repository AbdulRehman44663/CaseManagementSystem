<?php
namespace App\Services;

use App\Models\CaseType;

class CaseTypeService
{

    public function createCaseType($data)
    {
        try
        {
            $caseType = new CaseType();
            $caseType->name = $data['name'];
            $caseType->save();
            //session()->flash('success', 'Case Type saved successfully');
            return true;
        } catch (\Throwable $th) {
            $errorMessage = 'Unable to handle request! Error on line ' . $th->getLine();
            //session()->flash('error', $errorMessage);
            return false;
        }
    }

    public function updateCaseType($data, $id)
    {
        try {
            $caseType = CaseType::findOrFail($id);
    
            // Update the fields
            $caseType->name = $data['name'];
            $caseType->save();
            
            //session()->flash('success', 'Case Type updated successfully');
            return true;
        } catch (\Throwable $th) {
            $errorMessage = 'Unable to handle request! Error on line ' . $th->getLine() . ': ' . $th->getMessage();
            //session()->flash('error', $errorMessage);
            return false;
        }
    }
}