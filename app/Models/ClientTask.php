<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClientTask extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

     
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_assigned', 'id', 'user_id');
    }
}
