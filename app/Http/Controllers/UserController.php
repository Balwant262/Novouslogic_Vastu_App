<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
            'user_id' => 'required',
            'address_name' => 'required',
            'address_line_1' => 'required',
            'city_id' => 'required',
            'status' => 'required',
            'is_default' => 'required',
        ]);

        User::create($request->all());

        return redirect()->route('users.index')->with('success', 'User Address created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserController  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function show(UserController $userAddress)
    {
        return view('admin.users.show', compact('userAddress'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserController  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function edit(UserController $userAddress)
    {
        $users = User::all();
        $cities = User::all();
        return view('admin.users.edit', compact('userAddress','users','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserController  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserController $userAddress)
    {
        $request->validate([
            'user_id' => 'required',
            'address_name' => 'required',
            'address_line_1' => 'required',
            'city_id' => 'required',
            'status' => 'required',
            'is_default' => 'required',
        ]);
        
        $userAddress->update($request->all());

        return redirect()->route('users.index')->with('success', 'User Address updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserController  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserController $userAddress)
    {
        $userAddress->delete();
        
        return redirect()->route('users.index')
            ->with('success', 'User Address deleted successfully');
    }
}
