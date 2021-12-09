<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('admin.users.create', compact('users'));
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
            'name' => 'required',
            'email' => 'required',
            'contact_number' => 'required',
            'password' => 'required',
            'status' => 'required',
        ]);

        if($request->is_admin == 2){
            $isadmin = '1';
            $role = 'Superadmin';
        }elseif ($request->is_admin == 1) {
            $isadmin = '1';
            $role = 'Agent';
        }else{
            $isadmin = '0';
            $role = 'User';
        }
           
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'contact_number' => $request->contact_number,
            'is_admin' => $isadmin,
            'role' => $role,
            'status' => $request->status,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function show(User $users)
    {
        return view('admin.users.show', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'contact_number' => 'required',
            'status' => 'required',
        ]);
        
        if($request->is_admin == 2){
            $isadmin = '1';
            $role = 'Superadmin';
        }elseif ($request->is_admin == 1) {
            $isadmin = '1';
            $role = 'Agent';
        }else{
            $isadmin = '0';
            $role = 'User';
        }
        
       // $user->update($request->all());
        $zone = User::find($user->id);
        $zone->name = $request->input('name');
        $zone->email = $request->input('email');
        $zone->contact_number = $request->input('contact_number');
        $zone->status = $request->input('status');
        $zone->no_of_report_generate = $request->input('no_of_report_generate');
        $zone->fcm_id = $request->input('fcm_id');
        $zone->is_admin = $isadmin;
        $zone->role = $role;
        $zone->update();
        
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    
    public function reset_password(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);
        
       // $user->update($request->all());
        $zone = User::find($request->input('id'));
        $zone->password = Hash::make($request->input('password'));
        $zone->update();
        
        return redirect()->route('users.index')->with('success', 'User Password Reset successfully');
    }
    
    
    
    public function destroy(User $user)
    {
        $user->delete();
        
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
