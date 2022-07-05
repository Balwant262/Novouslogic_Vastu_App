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
use App\Models\User;

class QuestionnairAnswerApiController extends BaseController
{
   
    public function get_user_answers(Request $request)
    {
        $activity = QuestionnairAnswer::leftjoin('users', 'users.id', '=', 'questionnair_answers.user_id')
                ->leftjoin('questionnair_questions', 'questionnair_questions.id', '=', 'questionnair_answers.question_id')
                ->where('users.id', auth()->user()->id)
                ->where('questionnair_answers.question_id', $request->question_id)
                ->orderByDesc('questionnair_answers.created_at')
                ->get(['questionnair_answers.*', 'users.name', 'questionnair_questions.question']);
        
        if(!empty($activity))
            return $this->sendResponse($activity, 'User Answers Found Successfully');
        else
            return $this->sendResponse('success', 'User Answers Not Found');
    }
    
    public function save_user_answers(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'question_id' => 'required',
            'answer' => 'required',
        ]);

        try{
            QuestionnairAnswer::create($request->all());
            
            $zone = User::find($request->user_id);
            $zone->is_questionnair_fill = '1';
            $zone->update();
            
        } catch (\Exception $e) {
            return $this->sendError('Error', 'User Answers Not Save....please try again later');
        }
        return $this->sendResponse('success', 'User Answers successfully.');
    }
    
    
    public function check_user_answers(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'question_id' => 'required',
        ]);

        try{
            $answers = QuestionnairAnswer::where('user_id', '=', $request->user_id)->where('question_id', '=', $request->question_id)->first();
            
        } catch (\Exception $e) {
            return $this->sendError('Error', 'User Answers Not Found');
        }
        return $this->sendResponse($answers, 'User Answers Found.');
    }
    
    
    
    
}

