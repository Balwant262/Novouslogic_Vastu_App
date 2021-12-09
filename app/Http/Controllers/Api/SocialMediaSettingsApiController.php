<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\SocialMediaSettings;


class SocialMediaSettingsApiController extends BaseController
{
   
    public function social_media_settings(Request $request)
    {
        $activity = SocialMediaSettings::all();
        return $this->sendResponse($activity, 'Social Media Settings Found Successfully');
    }
    
}

