<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Models\Activity;


class ActivityApiController extends BaseController
{
   
    public function get_activity(Request $request)
    {
        $activity = Activity::all();
        return $this->sendResponse($activity, 'Activity Found Successfully');
    }
    
}

