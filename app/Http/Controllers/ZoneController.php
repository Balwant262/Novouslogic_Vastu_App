<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function index()
    {
        $zone = Zone::all();
        return view('admin.zone.index', compact('zone'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function store(Request $request)
    {
        $request->validate([
            'direction_name' => 'required',
            'synonym' => 'required',
        ]);

        Zone::create($request->all());

        return redirect()->route('zone.index')->with('success', 'Zone created successfully.');
    }

    public function update(Request $request, Zone $zon)
    {
        $request->validate([
            'direction_name' => 'required',
            'synonym' => 'required',
        ]);
        
        $zone = Zone::find($request->input('id'));
        $zone->direction_name = $request->input('direction_name');
        $zone->synonym = $request->input('synonym');
        $zone->update();

        return redirect()->route('zone.index')->with('success', 'Zone updated successfully');
    }

    public function destroy(Request $request, Zone $zon)
    {
        $zone = Zone::find($request->input('id'));
        $zone->delete();
        
        return redirect()->route('zone.index')->with('success', 'Zone deleted successfully');
    }
}
