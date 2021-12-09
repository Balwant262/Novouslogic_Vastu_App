<?php

namespace App\Http\Controllers\Agent;
use Illuminate\Routing\Controller;

use App\Models\UserLayout;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\Zone;
use App\Models\Activity;
use Illuminate\Http\Request;

class UserLayoutAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_layout = UserLayout::join('users', 'users.id', '=', 'user_home_layout.user_id')
                ->join('user_address', 'user_address.id', '=', 'user_home_layout.address_id')
                ->join('zone', 'zone.id', '=', 'user_home_layout.zone_id')
                ->join('activity', 'activity.id', '=', 'user_home_layout.activity_id')
                ->get(['user_home_layout.*', 'users.name', 'user_address.address_name', 'activity.activity_name', 'zone.direction_name as zone_name']);
        $users = User::all();
        $address = UserAddress::all();
        $zones = Zone::all();
        $activitys = Activity::all();
        return view('agent.user_layout.index', compact('user_layout','users', 'address', 'zones', 'activitys'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'address_id' => 'required',
            'zone_id' => 'required',
            'activity_id' => 'required'
        ]);

        UserLayout::create($request->all());

        return redirect()->route('user_layout.index')->with('success', 'User Layouts created successfully.');
    }

    public function update(Request $request, UserLayout $userAddress)
    {
        $request->validate([
            'user_id' => 'required',
            'address_id' => 'required',
            'zone_id' => 'required',
            'activity_id' => 'required'
        ]);
        
        $zone = UserLayout::find($request->input('id'));
        $zone->user_id = $request->input('user_id');
        $zone->address_id = $request->input('address_id');
        $zone->zone_id = $request->input('zone_id');
        $zone->activity_id = $request->input('activity_id');
        $zone->update();

        return redirect()->route('user_layout.index')->with('success', 'User Layouts updated successfully');
    }

    public function destroy(Request $request, UserLayout $userAddress)
    {
        $zone = Zone::find($request->input('id'));
        $zone->delete();
        
        return redirect()->route('user_layout.index')->with('success', 'User Layouts deleted successfully');
    }
}
