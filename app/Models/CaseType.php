<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];

    public function clientCaseInfo()
    {
        return $this->hasOne(ClientCaseInformation::class, 'case_type_id', 'id');
    }
    
    public function clientCases()
    {
        return $this->hasMany(ClientCaseInformation::class, 'case_type_id', 'id');
    }
}
