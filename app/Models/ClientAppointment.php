<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAppointment extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function appointmentColorLegend()
    {
        return $this->belongsTo(AppointmentColorLegend::class, 'type', 'id');
    }

    public function attorney()
    {
        return $this->belongsTo(Attorney::class, 'attorney_id', 'id');
    }

    public function appointmentLocation()
    {
        return $this->belongsTo(AppointmentLocations::class, 'appointment_location_id', 'id');
    }

    public function clientCaseinformation()
    {
        return $this->belongsTo(clientCaseinformation::class, 'client_case_information_id', 'id');
    }
     
}
