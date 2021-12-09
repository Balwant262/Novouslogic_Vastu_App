<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReport extends Model
{
    use HasFactory;
    
    protected $table = 'user_layout_reports';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'address_id',
        'generate_report',
    ];
}
