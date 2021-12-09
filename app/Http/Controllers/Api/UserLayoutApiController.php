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
use App\Models\User;
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
                ->get(['user_home_layout.*', 'users.name', 'user_address.address_name', 'activity.activity_name', 'zone.direction_name as zone_name']);
        
        return $this->sendResponse($user_layout, 'User Layout Found Successfully');
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

            }else{
                return $this->sendError('Error', 'Not Address Layout Found.. Please Add Layout....please try again later');
            }
            
            $report_data = DB::table('user_layout_reports')->where('user_id',$user_id)->where('address_id',$address_id)->get()->last();
            
        } catch (\Exception $e) {
            return $this->sendError('Error', 'Report Not Generated....please try again later');
        }
        return $this->sendResponse($report_data, 'User Report Generated successfully.');
    }
    
    public function get_all_user_generated_report(Request $request)
    {
        $user_appointment = DB::table('user_layout_reports')->where('user_id',auth()->user()->id)->get();
        return $this->sendResponse($user_appointment, 'User Layout Report Found Successfully');
    }
    
}

