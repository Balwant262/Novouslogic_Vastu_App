<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\QuestionnairQuestion;


class QuestionnairQuestionsApiController extends BaseController
{
   
    public function get_all_questions(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'address_id' => 'required',
        ]);
        
        $activity = QuestionnairQuestion::leftJoin('questionnair_answers', 'questionnair_answers.question_id', '=', 'questionnair_questions.id')
                ->where('questionnair_answers.user_id', $request->user_id)
                ->get(['questionnair_answers.answer', 'questionnair_questions.*']);
        return $this->sendResponse($activity, 'Questionnair Questions Found Successfully');
    }
    
}

