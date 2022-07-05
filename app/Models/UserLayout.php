<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLayout extends Model
{
    use HasFactory;
    
    protected $table = 'user_home_layout';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'address_id',
        'zone_id',
        'activity_id',
        'direction_degree',
        'grid_id',
        'grid_distance',
        'is_report_generate'
    ];
}
