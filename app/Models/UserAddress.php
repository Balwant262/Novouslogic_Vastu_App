<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    
    protected $table = 'user_address';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'address_name',
        'address_line_1',
        'address_line_2',
        'address_line_3',
        'city_id',
        'status',
        'is_default'
    ];
}
