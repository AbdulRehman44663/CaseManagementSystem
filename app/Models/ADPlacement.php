<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ADPlacement extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
       'description',
    ];
    
    public function clientAdPlacement()
    {
        return $this->hasMany(ClientCaseInformation::class, 'a_d_placement_id', 'id');
    }
}
