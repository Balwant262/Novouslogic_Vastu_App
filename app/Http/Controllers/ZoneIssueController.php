<?php

namespace App\Http\Controllers;

use App\Models\ZoneIssue;
use App\Models\Activity;
use App\Models\Zone;
use App\Models\Purpose;
use Illuminate\Http\Request;

class ZoneIssueController extends Controller
{
    public function index()
    {
        $attribute = ZoneIssue::join('activity', 'activity.id', '=', 'zone_activity_issue.activity_id')
                ->join('zone', 'zone.id', '=', 'zone_activity_issue.zone_id')
                ->join('purpose', 'purpose.id', '=', 'zone_activity_issue.zone_id')
                ->get(['zone_activity_issue.*', 'zone.direction_name as zone_name', 'activity.activity_name', 'purpose.name as purpose_name']);
        $activitys = Activity::all();
        $zones = Zone::all();
        $purposes = Purpose::all();
        return view('admin.zoneissue.index', compact('attribute','activitys','zones','purposes'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        $request->validate([
            'zone_id' => 'required',
            'activity_id' => 'required',
            'purpose_id' =>'required',
            'issue_facing' =>'required',
        ]);

        ZoneIssue::create($request->all());

        return redirect()->route('zone_issue.index')->with('success', 'Zone Activity Issue created successfully.');
    }

    public function update(Request $request, ZoneIssue $zon)
    {
        $request->validate([
            'zone_id' => 'required',
            'activity_id' => 'required',
            'purpose_id' =>'required',
            'issue_facing' =>'required',
        ]);
        
        $attribute = ZoneIssue::find($request->input('id'));
        $attribute->zone_id = $request->input('zone_id');
        $attribute->activity_id = $request->input('activity_id');
        $attribute->purpose_id = $request->input('purpose_id');
        $attribute->issue_facing = $request->input('issue_facing');
        $attribute->update();

        return redirect()->route('zone_issue.index')->with('success', 'Zone Activity Issue updated successfully');
    }

    public function destroy(Request $request, ZoneIssue $zon)
    {
        $attribute = ZoneIssue::find($request->input('id'));
        $attribute->delete();
        
        return redirect()->route('zone_issue.index')->with('success', 'Zone Activity Issue deleted successfully');
    }
}
