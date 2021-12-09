<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activity = Activity::all();
        return view('admin.activity.index', compact('activity'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        $request->validate([
            'activity_name' => 'required',
        ]);

        Activity::create($request->all());

        return redirect()->route('activity.index')->with('success', 'Activity created successfully.');
    }

    public function update(Request $request, Activity $zon)
    {
        $request->validate([
            'activity_name' => 'required',
        ]);
        
        $activity = Activity::find($request->input('id'));
        $activity->activity_name = $request->input('activity_name');
        $activity->update();

        return redirect()->route('activity.index')->with('success', 'Activity updated successfully');
    }

    public function destroy(Request $request, Activity $zon)
    {
        $activity = Activity::find($request->input('id'));
        $activity->delete();
        
        return redirect()->route('activity.index')->with('success', 'Activity deleted successfully');
    }
}
