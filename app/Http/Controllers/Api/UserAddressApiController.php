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
    
}

