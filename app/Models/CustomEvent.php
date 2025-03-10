<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomEvent extends Model
{
    use HasFactory;

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
}
