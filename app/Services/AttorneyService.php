<?php
namespace App\Services;

use App\Models\Attorney;

class AttorneyService
{
    public function createAttorney($data)
    {
        try
        {
            $attorney = new Attorney();
            $attorney->attorney_name  = $data['attorney_name'];
            $attorney->address        = $data['address'];
            $attorney->suite          = $data['suite'];
            $attorney->city_state_zip = $data['city_state_zip'];
            $attorney->phone_number   = $data['phone_number'];
            $attorney->email          = $data['email'];
            $attorney->save();

            //session()->flash('success', 'Attorney saved successfully');
            return true;
        } catch (\Throwable $th) {
            $errorMessage = 'Unable to handle request! Error on line ' . $th->getLine();
            //session()->flash('error', $errorMessage);
            return false;
        }
    }

    public function updateAttorney($data, $id)
    {
        try {
            $attorney = Attorney::findOrFail($id);
    
            // Update the fields
            $attorney->attorney_name  = $data['attorney_name'];
            $attorney->address        = $data['address'];
            $attorney->suite          = $data['suite'];
            $attorney->city_state_zip = $data['city_state_zip'];
            $attorney->phone_number   = $data['phone_number'];
            $attorney->email          = $data['email'];

            $attorney->save();
            
            session()->flash('success', 'Attorney updated successfully');
            return true;
        } catch (\Throwable $th) {
            $errorMessage = 'Unable to handle request! Error on line ' . $th->getLine() . ': ' . $th->getMessage();
            session()->flash('error', $errorMessage);
            return false;
        }
    }
}