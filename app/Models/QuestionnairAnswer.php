<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionnairAnswer extends Model
{
    use HasFactory;
    
    protected $table = 'questionnair_answers';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'answer',
        'question_id'
    ];
}
