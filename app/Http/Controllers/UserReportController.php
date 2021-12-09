<?php

namespace App\Http\Controllers;

use App\Models\UserReport;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserLayout;
use App\Models\ZoneIssue;
use Illuminate\Http\Request;
use DB;
use PDF;

class UserReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_report = UserReport::join('users', 'users.id', '=', 'user_layout_reports.user_id')
                ->join('user_address', 'user_address.id', '=', 'user_layout_reports.address_id')
                ->get(['user_layout_reports.*', 'users.name', 'user_address.address_name', 'user_address.address_line_1','user_address.address_line_2','user_address.address_line_1']);
        $users = User::all();
        $addrs = UserAddress::all();
        return view('admin.user_report.index', compact('user_report','users','addrs'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $addrs = UserAddress::all();
        return view('admin.user_report.create', compact('users','addrs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'address_id' => 'required',            
        ]);
        
        try{
            $user_id = $request->user_id;
            $address_id = $request->address_id;
            $current_time = \Carbon\Carbon::now()->timestamp;
            
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
                
                return redirect()->route('user_report.index')->with('success', 'Report Generated..!');
            }else{
                
                return redirect()->route('user_report.index')->with('success', 'Not Address Layout Found.. Please Add Layout....please try again later');
                
            }
            
            
            
        } catch (\Exception $e) {
            
            return redirect()->route('user_report.index')->with('success', 'Report Not Generated....please try again later');
            
        }

        return redirect()->route('user_report.index')->with('success', 'User Appointment created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserReport  $userReport
     * @return \Illuminate\Http\Response
     */
    public function show(UserReport $userReport)
    {
        return view('admin.user_report.show', compact('userAddress'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserReport  $userReport
     * @return \Illuminate\Http\Response
     */
    public function edit(UserReport $userReport)
    {
        $users = User::all();
        $addrs = UserAddress::all();
        return view('admin.user_report.edit', compact('userAddress','users','addrs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserReport  $userReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //var_dump('ok'); die;
        $request->validate([
            'user_id' => 'required',
            'address_id' => 'required',
        ]);
        
        try{
            $user_id = $request->user_id;
            $address_id = $request->address_id;
            $id = $request->id;
            $current_time = \Carbon\Carbon::now()->timestamp;
            
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

                DB::table('user_layout_reports')->where('id', $id)->update(['generate_report' => 'userReports/'.$filename]);
                
                return redirect()->route('user_report.index')->with('success', 'Report Generated..!');
            }else{
                
                return redirect()->route('user_report.index')->with('success', 'Not Address Layout Found.. Please Add Layout....please try again later');
                
            }
            
            
            
        } catch (\Exception $e) {
            
            return redirect()->route('user_report.index')->with('success', 'Report Not Generated....please try again later');
            
        }

        return redirect()->route('user_report.index')->with('success', 'User Appointment updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserReport  $userReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserReport $userReport)
    {
        $userReport->delete();
        
        return redirect()->route('user_report.index')->with('success', 'User Appointment deleted successfully');
    }
}
