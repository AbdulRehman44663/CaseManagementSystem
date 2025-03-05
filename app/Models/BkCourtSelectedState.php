<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BkCourtSelectedState extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function selectedCourtDistricts()
    {
        return $this->hasMany(BkCourtSelectedDistrict::class, 'bk_court_selected_state_id', 'id');
    }
}
