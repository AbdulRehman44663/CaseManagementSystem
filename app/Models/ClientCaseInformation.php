<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientCaseInformation extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function caseType()
    {
        return $this->belongsTo(CaseType::class, 'case_type_id', 'id');
    }

    public function leadSources()
    {
        return $this->belongsTo(LeadSources::class, 'lead_source_id', 'id');
    }
    
    public function adPlacement()
    {
        return $this->belongsTo(ADPlacement::class, 'a_d_placement_id', 'id');
    }

    public function opposingPartyInfo()
    {
        return $this->hasOne(OpposingPartyinfo::class, 'client_case_information_id', 'id');
    }

    public function clientIntakeInfo()
    {
        return $this->hasMany(ClientIntakeInformation::class, 'client_case_information_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
}
