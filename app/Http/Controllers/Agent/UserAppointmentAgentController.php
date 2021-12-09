<?php

namespace App\Http\Controllers\Agent;
use Illuminate\Routing\Controller;

use App\Models\UserAppointment;
use App\Models\User;
use Illuminate\Http\Request;

class UserAppointmentAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_appointment = UserAppointment::join('users', 'users.id', '=', 'users_appointment.user_id')
                ->leftjoin('users as users2', 'users2.id', '=', 'users_appointment.assigned_agent_id')
                ->get(['users_appointment.*', 'users.name', 'users2.name as assigned_agent_name']);
        $users = User::all();
        return view('agent.user_appointment.index', compact('user_appointment','users'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('agent.user_appointment.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'status' => 'required',
            'appointment_datetime' => 'required',
            'remarks' => 'required',
            
        ]);

        UserAppointment::create($request->all());

        return redirect()->route('user_appointment.index')->with('success', 'User Appointment created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserAppointment  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function show(UserAppointment $userAddress)
    {
        return view('agent.user_appointment.show', compact('userAddress'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserAppointment  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function edit(UserAppointment $userAddress)
    {
        $users = User::all();
        $cities = User::all();
        return view('agent.user_appointment.edit', compact('userAddress','users','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserAppointment  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserAppointment $userAddress)
    {
        $request->validate([
            'user_id' => 'required',
            'status' => 'required',
            'appointment_datetime' => 'required',
            'remarks' => 'required',
        ]);
        
        $zone = UserAppointment::find($request->input('id'));
        $zone->user_id = $request->input('user_id');
        $zone->status = $request->input('status');
        $zone->appointment_datetime = $request->input('appointment_datetime');
        $zone->remarks = $request->input('remarks');
        $zone->assigned_agent_id = $request->input('assigned_agent_id');
        $zone->update();

        return redirect()->route('user_appointment.index')->with('success', 'User Appointment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserAppointment  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAppointment $userAddress)
    {
        $userAddress->delete();
        
        return redirect()->route('user_appointment.index')->with('success', 'User Appointment deleted successfully');
    }
}
