<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
   

    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'entered_by', 'id');
    }

    public function clientCaseInfo()
    {
        return $this->hasOne(ClientCaseInformation::class, 'client_id', 'id');
    }

    public function clientCasesInfo()
    {
        return $this->hasMany(ClientCaseInformation::class, 'client_id', 'id');
    }
    
    public function clientStatus()
    {
        return $this->belongsTo(ClientStatus::class, 'client_status_id', 'id');
    }

    public function leadStatus()
    {
        return $this->belongsTo(LeadStatus::class, 'lead_status_id', 'id');
    }

    public function leadConversations()
    {
        return $this->hasMany(ConversationLog::class, 'client_id', 'id');
    }
}

