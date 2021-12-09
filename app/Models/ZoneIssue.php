<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoneIssue extends Model
{
    use HasFactory;
    
    protected $table = 'zone_activity_issue';
    public $timestamps = true;

    protected $fillable = [
        'activity_id',
        'zone_id',
        'purpose_id',
        'issue_facing'
    ];
}
