<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\DirectionAttribute;


class DirectionAttributeApiController extends BaseController
{
   
    public function get_direction_attribute(Request $request)
    {
        $attribute = DirectionAttribute::join('attributes', 'attributes.id', '=', 'directions_and_attributes.attribute_id')
                ->join('zone', 'zone.id', '=', 'directions_and_attributes.zone_id')
                ->get(['directions_and_attributes.*', 'attributes.name as attribute_name', 'zone.direction_name']);
        return $this->sendResponse($attribute, 'Activity Found Successfully');
    }
    
}

