<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\QuestionnairAnswer;


class QuestionnairAnswerApiController extends BaseController
{
   
    public function get_user_answers(Request $request)
    {
        $activity = QuestionnairAnswer::leftjoin('users', 'users.id', '=', 'questionnair_answers.user_id')
                ->leftjoin('questionnair_questions', 'questionnair_questions.id', '=', 'questionnair_answers.question_id')
                ->where('users.id', auth()->user()->id)
                ->get(['questionnair_answers.*', 'users.name', 'questionnair_questions.question']);
        
        return $this->sendResponse($activity, 'User Answers Found Successfully');
    }
    
    public function save_user_answers(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'question_id' => 'required',
            'answer' => 'required',
        ]);

        try{
            UserAppointment::create($request->all());
        } catch (\Exception $e) {
            return $this->sendError('Error', 'User Answers Not Save....please try again later');
        }
        return $this->sendResponse('success', 'User Answers successfully.');
    }
    
}

