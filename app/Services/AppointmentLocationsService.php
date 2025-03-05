<?php

namespace App\Services;

use App\Models\AppointmentLocations;
 

class AppointmentLocationsService
{
    public function create($requestData)
    {
        try
        {
            $appointmentLocations = new AppointmentLocations();
            $appointmentLocations->address = $requestData['address'];
            $appointmentLocations->suite = $requestData['suite'];
            $appointmentLocations->city = $requestData['city'];
            $appointmentLocations->state = $requestData['state'];
            $appointmentLocations->zip_code = $requestData['zip_code'];
            $appointmentLocations->save();
            session()->flash('success', 'Appointment Location saved successfully');
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
            $appointmentLocations = AppointmentLocations::findOrFail($id);
    
            // Update the fields
            $appointmentLocations->address = $requestData['address'];
            $appointmentLocations->suite = $requestData['suite'];
            $appointmentLocations->city = $requestData['city'];
            $appointmentLocations->state = $requestData['state'];
            $appointmentLocations->zip_code = $requestData['zip_code'];
            $appointmentLocations->save();
            
            session()->flash('success', 'Appointment Location updated successfully');
            return true;
        } catch (\Throwable $th) {
            $errorMessage = 'Unable to handle request! Error on line ' . $th->getLine() . ': ' . $th->getMessage();
            session()->flash('error', $errorMessage);
            return false;
        }
    }
    
    public function delete($id)
    {
        try {
            $appointmentLocations = AppointmentLocations::findOrFail($id);
            $appointmentLocations->delete();
            
            session()->flash('success', 'Appointment Location deleted successfully');
            return true;
        } catch (\Throwable $th) {
            $errorMessage = 'Unable to handle request! Error on line ' . $th->getLine() . ': ' . $th->getMessage();
            session()->flash('error', $errorMessage);
            return false;
        }
    }
} 
     