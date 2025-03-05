<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BkCourtState extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function courtDistricts()
    {
        return $this->hasMany(BkCourtDistrict::class, 'bk_court_state_id', 'id');
    }
}
