<?php

namespace App\Http\Controllers;

use App\Models\QuestionnairQuestion;
use Illuminate\Http\Request;

class QuestionnairQuestionsController extends Controller
{
    public function index()
    {
        $questions = QuestionnairQuestion::all();
        return view('admin.questionnair_questions.index', compact('questions'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
        ]);

        QuestionnairQuestion::create($request->all());

        return redirect()->route('questionnair_questions.index')->with('success', 'Questionnair Question created successfully.');
    }

    public function update(Request $request, QuestionnairQuestion $zon)
    {
        $request->validate([
            'question' => 'required',
            
        ]);
        
        $questions = QuestionnairQuestion::find($request->input('id'));
        $questions->question = $request->input('question');
        $questions->update();

        return redirect()->route('questionnair_questions.index')->with('success', 'Questionnair Question updated successfully');
    }

    public function destroy(Request $request, QuestionnairQuestion $questions)
    {
        $questions = QuestionnairQuestion::find($request->input('id'));
        $questions->delete();
        
        return redirect()->route('questionnair_questions.index')->with('success', 'Questionnair Question deleted successfully');
    }
}
