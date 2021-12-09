<?php

namespace App\Http\Controllers;

use App\Models\QuestionnairAnswer;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\QuestionnairQuestion;

class QuestionnairAnswerController extends Controller
{
    public function index()
    {
        $anss = QuestionnairAnswer::leftjoin('users', 'users.id', '=', 'questionnair_answers.user_id')
                ->leftjoin('questionnair_questions', 'questionnair_questions.id', '=', 'questionnair_answers.question_id')
                ->get(['questionnair_answers.*', 'users.name', 'questionnair_questions.question']);
        
        $users = User::all();
        $questions = QuestionnairQuestion::all();
        return view('admin.questionnair_answer.index', compact('anss','users','questions'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'question_id' => 'required',
            'answer' => 'required',
        ]);

        QuestionnairAnswer::create($request->all());

        return redirect()->route('user_questionnair_answer.index')->with('success', 'Questionnair Question created successfully.');
    }

    public function update(Request $request, QuestionnairAnswer $zon)
    {
        $request->validate([
            'user_id' => 'required',
            'question_id' => 'required',
            'answer' => 'required',
        ]);
        
        $questions = QuestionnairAnswer::find($request->input('id'));
        $questions->user_id = $request->input('user_id');
        $questions->question_id = $request->input('question_id');
        $questions->answer = $request->input('answer');
        $questions->update();

        return redirect()->route('user_questionnair_answer.index')->with('success', 'Questionnair Question updated successfully');
    }

    public function destroy(Request $request, QuestionnairAnswer $questions)
    {
        $questions = QuestionnairAnswer::find($request->input('id'));
        $questions->delete();
        
        return redirect()->route('user_questionnair_answer.index')->with('success', 'Questionnair Question deleted successfully');
    }
}
