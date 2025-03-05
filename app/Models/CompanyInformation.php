<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'attorney_1',
        'attorney_2',
        'attorney_3',
        'address',
        'suite',
        'city_state_zip',
        'telephone_no',
        'fax_no',
        'email',
        'email_signature',
        'show_email_signature',
        'logo',
        'signature',
    ];
}
