<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAppointment;
use App\Models\Videotip;
use App\Models\News;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_count = User::where('status','1')->where('is_admin','0')->count();
        $papp_count = UserAppointment::where('status','1')->count();
        $aapp_count = UserAppointment::where('status','4')->count();
        $capp_count = UserAppointment::where('status','5')->count();
        $v_count = Videotip::count();
        $ann_count = News::count();
        return view('agent.home', compact('user_count','papp_count','aapp_count','capp_count','v_count','ann_count'));
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        $user_count = User::where('status','1')->where('is_admin','0')->count();
        $papp_count = UserAppointment::where('status','1')->count();
        $aapp_count = UserAppointment::where('status','4')->count();
        $capp_count = UserAppointment::where('status','5')->count();
        $v_count = Videotip::count();
        $ann_count = News::count();
        return view('admin.adminHome', compact('user_count','papp_count','aapp_count','capp_count','v_count','ann_count'));
    }
}
