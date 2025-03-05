<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'client_id',
        'client_case_information_id',
        'details',
        'date',
        'time',
        'assigned_to',
        'assigned_by',
        'completed',
    ];

    // Define the many-to-many relationship
    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('assigned_by', 'status')->withTimestamps();
    }

    // Optionally, you can create a helper method to get the status of a user-task assignment
    public function userStatus($userId)
    {
        return $this->users()->wherePivot('user_id', $userId)->first()->pivot->status ?? 'pending';
    }

    public function assignedUsers()
    {
        return $this->belongsToMany(User::class, 'task_user', 'task_id', 'user_id');
    }

    // Relationship with the user who assigned the task
    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
}
