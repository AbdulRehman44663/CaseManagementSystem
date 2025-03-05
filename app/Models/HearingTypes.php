<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HearingTypes extends Model
{
    use HasFactory;

    public function caseType()
    {
        return $this->belongsTo(CaseType::class, 'case_type_id', 'id');
    }
}
