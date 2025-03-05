<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenaralCourtState extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function generalCourtCountry()
    {
        return $this->hasMany(GenaralCourtCountryOther::class, 'genaral_court_state_id', 'id');
    }
}
