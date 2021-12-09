<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\UserAppointment;

class UserAppointmentApiController extends BaseController
{
   
    public function get_user_appointment(Request $request)
    {
        $user_appointment = UserAppointment::join('users', 'users.id', '=', 'users_appointment.user_id')
                ->leftjoin('users as users2', 'users2.id', '=', 'users_appointment.assigned_agent_id')
                ->where('users.id', auth()->user()->id)
                ->get(['users_appointment.*', 'users.name', 'users2.name as assigned_agent_name']);
        return $this->sendResponse($user_appointment, 'Appointment Found Successfully');
    }
    
    public function book_user_appointment(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'appointment_datetime' => 'required',
            'remarks' => 'required',
        ]);

        try{
            UserAppointment::create($request->all());
        } catch (\Exception $e) {
            return $this->sendError('Error', 'Appointment Not Booking....please try again later');
        }
        return $this->sendResponse('success', 'User Appointment Booked successfully.');
    }
    
    
    
}

