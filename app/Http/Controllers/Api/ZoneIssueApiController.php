<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\ZoneIssue;


class ZoneIssueApiController extends BaseController
{
   
    public function get_zone_issue(Request $request)
    {
        $attribute = ZoneIssue::join('activity', 'activity.id', '=', 'zone_activity_issue.activity_id')
                ->join('zone', 'zone.id', '=', 'zone_activity_issue.zone_id')
                ->join('purpose', 'purpose.id', '=', 'zone_activity_issue.zone_id')
                ->get(['zone_activity_issue.*', 'zone.direction_name as zone_name', 'activity.activity_name', 'purpose.name as purpose_name']);
        
        return $this->sendResponse($attribute, 'Zone Isuue Found Successfully');
    }
    
}

