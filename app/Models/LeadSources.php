<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadSources extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function clientLeads()
    {
        return $this->hasMany(ClientCaseInformation::class, 'lead_source_id', 'id');
    }
}
