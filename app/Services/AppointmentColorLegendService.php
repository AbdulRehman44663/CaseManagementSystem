<?php

namespace App\Services;

use App\Models\AppointmentColorLegend;

class AppointmentColorLegendService
{
    public function createAppointmentLegend($data)
    {
        try
        {
            $appointment = new AppointmentColorLegend();
            $appointment->name = $data['name'];
            $appointment->color = $data['color'];
            $appointment->save();
            return true;
        } catch (\Throwable $th) {
            $errorMessage = 'Unable to handle request! Error on line ' . $th->getLine();
           // session()->flash('error', $errorMessage);
            return false;
        }
    }

    public function updateAppointmentLegend($data, $appointmentId)
    {
        try {
            $appointment = AppointmentColorLegend::findOrFail($appointmentId);
    
            // Update the fields
            $appointment->name = $data['name'];
            $appointment->color = $data['color'];
            $appointment->save();
            return true;
        } catch (\Throwable $th) {
            //$errorMessage = 'Unable to handle request! Error on line ' . $th->getLine() . ': ' . $th->getMessage();
            //session()->flash('error', $errorMessage);
            return false;
        }
    }
}