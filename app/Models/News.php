<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    
    protected $table = 'announcement_news';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'description',
        'source_link'
    ];
}
