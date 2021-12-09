<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionnairQuestion extends Model
{
    use HasFactory;
    
    protected $table = 'questionnair_questions';
    public $timestamps = true;

    protected $fillable = [
        'question',
        'frm_option',
        'type'
    ];
}
