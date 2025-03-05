<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSelectedState extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function selectedCourtCountry()
    {
        return $this->hasMany(GenSelectedCountry::class, 'general_selected_state_id', 'id');
    }
}
