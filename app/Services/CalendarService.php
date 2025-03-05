<?php
namespace App\Services;

use App\Models\ClientAppointment;
use App\Models\CustomEvent;

class CalendarService
{
    public function createEvent($data)
    {
        try
        {
            $customEvent = new CustomEvent();
            $customEvent->client_id = $data['name'];
            $customEvent->subject = $data['subject'];
            $customEvent->date = $data['date'];
            $customEvent->time = $data['time'];

            $customEvent->save();

            return true;
        } catch (\Throwable $th) {
            $errorMessage = 'Unable to handle request! Error on line ' . $th->getLine();
           
            return false;
        }
    }

    public function updateCalendarAppointmentEvent($data, $id)
    {
        try
        {
            $clientAppointment = ClientAppointment::find($id);
            $clientAppointment->type = $data['type'];
            $clientAppointment->attorney_id  = $data['attorney'];
            $clientAppointment->appointment_location_id = $data['location'];
            $clientAppointment->time = $data['time'];
            $clientAppointment->status = $data['status'];

            $clientAppointment->save();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function updateCalendarCustomEvent($data, $id)
    {
        try
        {
            $customEvent = CustomEvent::find($id);
            $customEvent->subject = $data['subject'];
            $customEvent->time = $data['time'];
            
            $customEvent->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    
}