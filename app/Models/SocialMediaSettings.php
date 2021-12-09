<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaSettings extends Model
{
    use HasFactory;
    
    protected $table = 'social_media_settings';
    public $timestamps = true;

    protected $fillable = [
        'show_in_the_application',
        'youtube_page',
        'facebook_page',
        'instagram_page',
        'linkedIn_page',
        'tweeter_page'
    ];
}
