<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAppointment extends Model
{
    use HasFactory;
    
    protected $table = 'users_appointment';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'appointment_datetime',
        'assigned_agent_id',
        'status',
        'remarks'
    ];
}
