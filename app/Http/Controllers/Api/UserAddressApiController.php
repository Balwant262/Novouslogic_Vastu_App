<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\UserAddress;


class UserAddressApiController extends BaseController
{
   
    public function get_user_address(Request $request)
    {
        $user_address = UserAddress::join('users', 'users.id', '=', 'user_address.user_id')
                ->join('cities', 'cities.id', '=', 'user_address.city_id')
                ->where('users.id', auth()->user()->id)
                ->get(['user_address.*', 'users.name', 'cities.name as city_name']);
        return $this->sendResponse($user_address, 'Address Found Successfully');
    }
    
    public function add_user_address(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'address_name' => 'required',
            'address_line_1' => 'required',
            'city_id' => 'required',
            'status' => 'required',
            'is_default' => 'required',
        ]);

        try{
            UserAddress::create($request->all());
        } catch (\Exception $e) {
            return $this->sendError('Error', 'User Address Not Save....please try again later');
        }
        return $this->sendResponse('success', 'User AddresscAdded successfully.');
        
    }
    
    public function update_user_address(Request $request)
    {
        $request->validate([
            'address_id' => 'required',
            'user_id' => 'required',
            'address_name' => 'required',
            'address_line_1' => 'required',
            'city_id' => 'required',
            'status' => 'required',
            'is_default' => 'required',
        ]);

        try{
        
        $id = $request->address_id;
        $address = UserAddress::find($id);
        $address->user_id = $request->user_id;
        $address->address_name = $request->address_name;
        $address->address_line_1 = $request->address_line_1;
        $address->address_line_2 = $request->address_line_2;
        $address->address_line_3 = $request->address_line_3;
        $address->city_id = $request->city_id;
        $address->status = $request->status;
        $address->is_default = $request->is_default;
        $address->save();    
            
        } catch (\Exception $e) {
            return $this->sendError('Error', 'User Address Not Update....please try again later');
        }
        return $this->sendResponse('success', 'User Address Update successfully.');
    }
    
}

