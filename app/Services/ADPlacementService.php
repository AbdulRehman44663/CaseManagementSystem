<?php
namespace App\Services;

use App\Models\ADPlacement;
use App\Models\CaseType;

class ADPlacementService
{

    public function createAdPlacement($data)
    {
        try
        {
            $adPlacement = new ADPlacement();
            $adPlacement->name = $data['name'];
            $adPlacement->save();
            //session()->flash('success', 'AD Placement saved successfully');
            return true;
        } catch (\Throwable $th) {
            $errorMessage = 'Unable to handle request! Error on line ' . $th->getLine();
           // session()->flash('error', $errorMessage);
            return false;
        }
    }

    public function updateAdPlacement($data, $id)
    {
        try {
            $adPlacement = ADPlacement::findOrFail($id);
    
            // Update the fields
            $adPlacement->name = $data['name'];
            $adPlacement->save();
            
            //session()->flash('success', 'AD Placement updated successfully');
            return true;
        } catch (\Throwable $th) {
            $errorMessage = 'Unable to handle request! Error on line ' . $th->getLine() . ': ' . $th->getMessage();
            session()->flash('error', $errorMessage);
            return false;
        }
    }
}