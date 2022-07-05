<?php

namespace App\Http\Controllers;

use App\Models\UserAddress;
use App\Models\User;
use App\Models\Cities;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_address = UserAddress::join('users', 'users.id', '=', 'user_address.user_id')->get(['user_address.*', 'users.name']);
        return view('admin.user_address.index', compact('user_address'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $cities = Cities::all();
        return view('admin.user_address.create', compact('users','cities'));
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
            'address_type' => 'required',
            'status' => 'required',
            'is_default' => 'required',
        ]);

        UserAddress::create($request->all());

        return redirect()->route('user_address.index')->with('success', 'User Property created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserAddress  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function show(UserAddress $userAddress)
    {
        return view('admin.user_address.show', compact('userAddress'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserAddress  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function edit(UserAddress $userAddress)
    {
        $users = User::all();
        $cities = Cities::all();
        return view('admin.user_address.edit', compact('userAddress','users','cities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserAddress  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserAddress $userAddress)
    {
        $request->validate([
            'user_id' => 'required',
            'address_name' => 'required',
            'address_type' => 'required',
            'status' => 'required',
            'is_default' => 'required',
        ]);
        
        $userAddress->update($request->all());

        return redirect()->route('user_address.index')->with('success', 'User Property updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserAddress  $userAddress
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserAddress $userAddress)
    {
        $userAddress->delete();
        
        return redirect()->route('user_address.index')->with('success', 'User Property deleted successfully');
    }
}
