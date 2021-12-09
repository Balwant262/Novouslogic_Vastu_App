<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAddressController;
use App\Http\Controllers\UserLayoutController;
use App\Http\Controllers\UserAppointmentController;
use App\Http\Controllers\UserReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\PurposeController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\VideotipsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\DirectionAttributeController;
use App\Http\Controllers\ZoneIssueController;
use App\Http\Controllers\SocialMediaSettingsController;
use App\Http\Controllers\QuestionnairQuestionsController;
use App\Http\Controllers\QuestionnairAnswerController;

use App\Http\Controllers\Agent\UserAddressAgentController;
use App\Http\Controllers\Agent\UserLayoutAgentController;
use App\Http\Controllers\Agent\UserAppointmentAgentController;
use App\Http\Controllers\Agent\UserReportAgentController;
use App\Http\Controllers\Agent\UserAgentController;
use App\Http\Controllers\Agent\VideotipsAgentController;
use App\Http\Controllers\Agent\NewsAgentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['prefix'=>'admin'], function(){
    // put your code here
Route::get('home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::post('reset_password', 'App\Http\Controllers\UserController@reset_password')->name('users.reset_password')->middleware('is_admin');
Route::resource('user_address', UserAddressController::class)->middleware('is_admin');
Route::resource('user_layout', UserLayoutController::class)->middleware('is_admin');
Route::resource('user_appointment', UserAppointmentController::class)->middleware('is_admin');
Route::resource('user_report', UserReportController::class)->middleware('is_admin');
Route::resource('users', UserController::class)->middleware('is_admin');
Route::resource('zone', ZoneController::class)->middleware('is_admin');
Route::resource('activity', ActivityController::class)->middleware('is_admin');
Route::resource('purpose', PurposeController::class)->middleware('is_admin');
Route::resource('attribute', AttributeController::class)->middleware('is_admin');
Route::resource('videotips', VideotipsController::class)->middleware('is_admin');
Route::resource('news', NewsController::class)->middleware('is_admin');
Route::resource('direction_attribute', DirectionAttributeController::class)->middleware('is_admin');
Route::resource('zone_issue', ZoneIssueController::class)->middleware('is_admin');
Route::resource('social_media_settings', SocialMediaSettingsController::class)->middleware('is_admin');
Route::resource('questionnair_questions', QuestionnairQuestionsController::class)->middleware('is_admin');
Route::resource('user_questionnair_answer', QuestionnairAnswerController::class)->middleware('is_admin');
});


Route::group(['prefix'=>'agent'], function(){
    
Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('agent.home');
Route::resource('agent_user_address', UserAddressAgentController::class);
Route::resource('agent_user_layout', UserLayoutAgentController::class);
Route::resource('agent_user_appointment', UserAppointmentAgentController::class);
Route::resource('agent_user_report', UserReportAgentController::class);
Route::resource('agent_users', UserAgentController::class);
Route::resource('agent_videotips', VideotipsAgentController::class);
Route::resource('agent_news', NewsAgentController::class);

});
//Route::get('/superadmin/home', [App\Http\Controllers\SuperAdminHomeController::class, 'superadminHome'])->name('admin')->middleware('superadmin');