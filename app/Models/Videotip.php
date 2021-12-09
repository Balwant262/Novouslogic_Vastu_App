<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videotip extends Model
{
    use HasFactory;
    
    protected $table = 'videos_and_tips';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'source_link'
    ];
}
