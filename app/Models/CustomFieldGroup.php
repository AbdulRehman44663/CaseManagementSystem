<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomFieldGroup extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function customFieldDetail()
    {
        return $this->hasMany(CustomFieldGroupDetail::class, 'custom_field_group_id', 'id');
    }
}
