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
use App\Models\User;

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
            
            $user = User::where('id', '=', $request->user_id)->first();
            $datetime = date('d-m-Y | h:m', strtotime($request->appointment_datetime));
            
            $to = $user->email;
            $subject = "Appointment Booked Successfully";

            $message = "<b>Appointment Booked Successfully.</b><br>";
            $message .= "<h1>Appointment DateTime: ".$datetime."</h1><br>";

            $header = "From:pavan.patil@taxivaxi.com \r\n";
            $header .= "Cc:balwant@taxivaxi.com \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";

            $retval = mail ($to,$subject, $message, $header);
            
            
        } catch (\Exception $e) {
            return $this->sendError('Error', 'Appointment Not Booking....please try again later');
        }
        return $this->sendResponse('success', 'User Appointment Booked Successfully.');
    }
    
    
    
}

