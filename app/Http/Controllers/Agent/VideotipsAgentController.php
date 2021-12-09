<?php

namespace App\Http\Controllers\Agent;
use Illuminate\Routing\Controller;

use App\Models\Videotip;
use Illuminate\Http\Request;

class VideotipsAgentController extends Controller
{
    public function index()
    {
        $videotip = Videotip::all();
        return view('agent.videotip.index', compact('videotip'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);

        Videotip::create($request->all());

        return redirect()->route('videotips.index')->with('success', 'Videos & Tip created successfully.');
    }

    public function update(Request $request, Videotip $zon)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        
        $videotip = Videotip::find($request->input('id'));
        $videotip->name = $request->input('name');
        $videotip->description = $request->input('description');
        $videotip->source_link = $request->input('source_link');
        $videotip->update();

        return redirect()->route('videotips.index')->with('success', 'Videos & Tip updated successfully');
    }

    public function destroy(Request $request, Videotip $zon)
    {
        $videotip = Videotip::find($request->input('id'));
        $videotip->delete();
        
        return redirect()->route('videotips.index')->with('success', 'Videos & Tip deleted successfully');
    }
}
