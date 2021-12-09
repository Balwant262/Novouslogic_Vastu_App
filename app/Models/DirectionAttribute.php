<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectionAttribute extends Model
{
    use HasFactory;
    
    protected $table = 'directions_and_attributes';
    public $timestamps = true;

    protected $fillable = [
        'attribute_id',
        'zone_id'
    ];
}
