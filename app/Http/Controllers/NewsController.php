<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('admin.news.index', compact('news'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        News::create($request->all());

        return redirect()->route('news.index')->with('success', 'Announcement & News created successfully.');
    }

    public function update(Request $request, News $zon)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        
        $news = News::find($request->input('id'));
        $news->name = $request->input('name');
        $news->description = $request->input('description');
        $news->source_link = $request->input('source_link');
        $news->update();

        return redirect()->route('news.index')->with('success', 'Announcement & News updated successfully');
    }

    public function destroy(Request $request, News $zon)
    {
        $news = News::find($request->input('id'));
        $news->delete();
        
        return redirect()->route('news.index')->with('success', 'Announcement & News deleted successfully');
    }
}
