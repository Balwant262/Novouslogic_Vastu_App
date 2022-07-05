<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\API;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\UserLayout;
use App\Models\ZoneIssue;
use App\Models\Zone;
use App\Models\Activity;
use PDF;


class UserLayoutApiController extends BaseController
{
   
    public function get_user_layout(Request $request)
    {
        $user_layout = UserLayout::join('users', 'users.id', '=', 'user_home_layout.user_id')
                ->join('user_address', 'user_address.id', '=', 'user_home_layout.address_id')
                ->join('zone', 'zone.id', '=', 'user_home_layout.zone_id')
                ->join('activity', 'activity.id', '=', 'user_home_layout.activity_id')
                ->where('users.id', auth()->user()->id)
                ->where('user_home_layout.is_report_generate', 0)
                ->get(['user_home_layout.*', 'users.name', 'user_address.address_name', 'activity.activity_name', 'zone.direction_name as zone_name', 'zone.synonym as zone_synonym']);
        
        return $this->sendResponse($user_layout, 'User Layout Found Successfully');
    }
    
    
    public function remove_user_layout(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'address_id' => 'required',
            'zone_synonym' => 'required',
            'activity_name' => 'required',
        ]);
        
        try{
            $synonym = $request->zone_synonym;
            $activity_name = $request->activity_name;
            $zone_id = Zone::where('synonym', '=', $synonym)->select('id')->first(); 
            $activity_id = Activity::where('activity_name', '=', $activity_name)->select('id')->first();
            
            if($zone_id === null || $activity_id === null ){
                return $this->sendError('Error', 'Zone or Activity Not Found');
            }
            
            $user_layout = UserLayout::where('user_id', $request->user_id)->where('address_id', $request->address_id)
            ->where('zone_id', $zone_id->id)->where('activity_id', $activity_id->id)->delete();
        
            return $this->sendResponse($user_layout, 'User Layout Deleted Successfully');
        
        } catch (\Exception $e) {
            return $this->sendError('Error', 'User Layout Not Deleted....please try again later');
        }
    }
    
    
    public function reset_user_layout(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
        ]);
        
        try{
            
            $user_layout = UserLayout::where('user_id', $request->user_id)->delete();
        
            return $this->sendResponse($user_layout, 'User Layout Reset Successfully');
        
        } catch (\Exception $e) {
            return $this->sendError('Error', 'User Layout Not Reset....please try again later');
        }
    }
    
    
    public function save_user_layout(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'address_id' => 'required',
            'zone_synonym' => 'required',
            'activity_name' => 'required',
            'direction_degree' => 'required',
            'grid_id' => 'required',
        ]);
        
        try{
            $synonym = $request->zone_synonym;
            $activity_name = $request->activity_name;
            //UserLayout::create($request->all());
            $zone_id = Zone::where('synonym', '=', $synonym)->select('id')->first(); 
            $activity_id = Activity::where('activity_name', '=', $activity_name)->select('id')->first();
            
            if($zone_id === null || $activity_id === null ){
                return $this->sendError('Error', 'Zone or Activity Not Found');
            }
            
            $grid_distance = $this->get_grid_distance_by_id($request->grid_id);
            
            $layout = new UserLayout([
                    'user_id' => $request->user_id,
                    'address_id' => $request->address_id,
                    'zone_id' => $zone_id->id,
                    'activity_id' => $activity_id->id,
                    'direction_degree' => $request->direction_degree,
                    'grid_id' => $request->grid_id,
                    'grid_distance' => $grid_distance
            ]);
            $layout->save();
            
            
            
            
        } catch (\Exception $e) {
            return $this->sendError('Error', 'User Layout Not Save....please try again later');
        }
        return $this->sendResponse('success', 'User Layout Save successfully.');
    }
    
    public function generate_user_report(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'address_id' => 'required',
        ]);
        
        $current_time = \Carbon\Carbon::now()->timestamp;
        $user_id = $request->user_id;
        $address_id = $request->address_id;

        try{
            
            $activity_ids = UserLayout::select(DB::raw('GROUP_CONCAT(activity_id ORDER BY activity_id) AS act_ids'))
                    ->where('user_id',$user_id)->where('address_id',$address_id)
                    ->get();
            if($activity_ids){
              $activity_ids =  $activity_ids[0]->act_ids;
            }else{
                $activity_ids = 0;
            }

            $zone_ids = UserLayout::select(DB::raw('GROUP_CONCAT(zone_id ORDER BY activity_id) AS act_ids'))
                    ->where('user_id',$user_id)->where('address_id',$address_id)
                    ->get();
            if($zone_ids){
              $zone_ids =  $zone_ids[0]->act_ids;
            }else{
                $zone_ids = 0;
            }
            
            $issue_data = ZoneIssue::join('activity', 'activity.id', '=', 'zone_activity_issue.activity_id')
                ->join('zone', 'zone.id', '=', 'zone_activity_issue.zone_id')
                ->join('purpose', 'purpose.id', '=', 'zone_activity_issue.zone_id')
                ->whereIn('zone_id',[$zone_ids])->whereIn('activity_id',[$activity_ids])
                ->get(['zone_activity_issue.*', 'zone.direction_name as zone_name', 'activity.activity_name', 'purpose.name as purpose_name']);
        
            if(!empty($issue_data[0])){
                $issuedata = ['issues'=>$issue_data];
                $pdf = PDF::loadView('user_report_template', array('issuesdata'=>$issuedata));
                $pdf->setOptions(['isPhpEnabled' => true,'isRemoteEnabled' => true]);
                $filename = "Report_".$user_id."_".$address_id."_".$current_time.".pdf";
                // Save file to the directory
                $pdf->save('userReports/'.$filename);
                //Storage::put('public/userReports/'.$filename, $pdf->output());
                //Download Pdf
                //return $pdf->download('generatepdf.pdf');

                DB::table('user_layout_reports')->updateOrInsert(['user_id' => $user_id, 'address_id' => $address_id, 'generate_report'=>'userReports/'.$filename]);
                DB::table('users')->where('id', $user_id)->update(['no_of_report_generate' => DB::raw('no_of_report_generate+1')]);
                
                $affected = DB::table('user_home_layout')->where('user_id',$user_id)->where('address_id',$address_id)->update(array('is_report_generate' => 1));

            }else{
                $affected = DB::table('user_home_layout')->where('user_id',$user_id)->where('address_id',$address_id)->update(array('is_report_generate' => 1));
                return $this->sendResponse('1', 'No Issue found in our layout. please contact to our agent..!');
            }
            
            $report_data = DB::table('user_layout_reports')->where('user_id',$user_id)->where('address_id',$address_id)->get()->last();
            
        } catch (\Exception $e) {
            return $this->sendError('Error', 'Report Not Generated....please try again later');
        }
        return $this->sendResponse($report_data, 'User Report Generated successfully.');
    }
    
    public function get_all_user_generated_report(Request $request)
    {
        $user_appointment = DB::table('user_layout_reports')
                ->join('user_address', 'user_address.id', '=', 'user_layout_reports.address_id')
                ->where('user_layout_reports.user_id',auth()->user()->id)
                ->get(['user_layout_reports.*','user_address.address_name']);
        return $this->sendResponse($user_appointment, 'User Layout Report Found Successfully');
    }
    
    
    public function get_grid_distance_by_id($grid_id)
    {
        $grid_distance = '';

        $long = array(
        "a1", "a2", "a3", "a4", "a5", "a6", "a7", "a8", "a9", "a10", "a11", "a12",
        "b1", "b2", "b3", "b4", "b5", "b6", "b7", "b8", "b9", "b10", "b11", "b12",
        "c1", "c2", "c11","c12",
        "d1", "d2", "d11","d12",
        "e1", "e2", "e11","e12",
        "f1", "f2", "f11","f12",
        "g1", "g2", "g11","g12",
        "h1", "h2", "h11","h12",
        "i1", "i2", "i11","i12",
        "j1", "j2", "j11","j12",
        "k1", "k2", "k3", "k4", "k5", "k6", "k7", "k8", "k9", "k10", "k11", "k12",
        "l1", "l2", "l3", "l4", "l5", "l6", "l7", "l8", "l9", "l10", "l11", "l12"
        );

        $medium = array(
        "c3", "c4", "c5","c6","c7","c8","c9","c10",
        "d3", "d4", "d5","d6","d7","d8","d9","d10",
        "e3", "e4", "e9","e10",
        "f3", "f4", "f9","f10",
        "g3", "g4", "g9","g10",
        "h3", "h4", "h10","h10",
        "i3", "i4", "i5","i6","i7","i8","i9","i10",
        "j3", "c4", "c5","c6","c7","c8","c9","c10");

        $short = array("e5", "e6", "e7","e8",
        "f5", "f6", "f7","f8",
        "g5", "g6", "g7","g8",
        "h5", "h6", "h7","h8");

        if (in_array(strtolower($grid_id), $long))
        {
          $grid_distance = 'Long Distance';
        }

        if (in_array(strtolower($grid_id), $medium))
        {
          $grid_distance = 'Medium Distance';
        }

        if (in_array(strtolower($grid_id), $short))
        {
          $grid_distance = 'Nearby';
        }

        return $grid_distance;
    }
}

