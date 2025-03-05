<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseIntakeField extends Model
{
    use HasFactory;

    protected $casts = [
        'possible_options' => 'array',  // This will cast the JSON column to an array automatically
    ];
}
