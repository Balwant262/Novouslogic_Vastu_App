<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\API\ActivityApiController;
use App\Http\Controllers\API\AttributeApiController;
use App\Http\Controllers\API\DirectionAttributeApiController;
use App\Http\Controllers\API\NewsApiController;
use App\Http\Controllers\API\PurposeApiController;
use App\Http\Controllers\API\UserAddressApiController;
use App\Http\Controllers\API\UserAppointmentApiController;
use App\Http\Controllers\API\UserLayoutApiController;
use App\Http\Controllers\API\VideoTipsApiController;
use App\Http\Controllers\API\ZoneApiController;
use App\Http\Controllers\API\ZoneIssueApiController;
use App\Http\Controllers\API\SocialMediaSettingsApiController;
use App\Http\Controllers\API\QuestionnairQuestionsApiController;
use App\Http\Controllers\API\QuestionnairAnswerApiController;
use App\Http\Controllers\API\MasterApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('get_otp', [RegisterController::class, 'get_otp']);
Route::post('register', [RegisterController::class, 'register']);
Route::post('verify_otp', [RegisterController::class, 'login']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/profile', function(Request $request) {
        return auth()->user();
    });
    Route::post('/get_all_cities', [MasterApiController::class, 'get_all_cities']);
    Route::post('/get_activity', [ActivityApiController::class, 'get_activity']);
    Route::post('/get_attribute', [AttributeApiController::class, 'get_attribute']);
    Route::post('/get_direction_attribute', [DirectionAttributeApiController::class, 'get_direction_attribute']);
    Route::post('/get_news', [NewsApiController::class, 'get_news']);
    Route::post('/get_purpose', [PurposeApiController::class, 'get_purpose']);
    Route::post('/get_user_address', [UserAddressApiController::class, 'get_user_address']);
    Route::post('/add_user_address', [UserAddressApiController::class, 'add_user_address']);
    Route::post('/update_user_address', [UserAddressApiController::class, 'update_user_address']);
    Route::post('/get_user_appointment', [UserAppointmentApiController::class, 'get_user_appointment']);
    Route::post('/book_user_appointment', [UserAppointmentApiController::class, 'book_user_appointment']);
    Route::post('/generate_user_report', [UserLayoutApiController::class, 'generate_user_report']);
    Route::post('/get_all_user_generated_report', [UserLayoutApiController::class, 'get_all_user_generated_report']);
    Route::post('/get_user_layout', [UserLayoutApiController::class, 'get_user_layout']);
    Route::post('/save_user_layout', [UserLayoutApiController::class, 'save_user_layout']);
    Route::post('/get_video_tips', [VideoTipsApiController::class, 'get_video_tips']);
    Route::post('/get_zone', [ZoneApiController::class, 'get_zone']);
    Route::post('/get_zone_issue', [ZoneIssueApiController::class, 'get_zone_issue']);
    Route::post('/social_media_settings', [SocialMediaSettingsApiController::class, 'social_media_settings']);
    Route::post('/get_all_questions', [QuestionnairQuestionsApiController::class, 'get_all_questions']);
    Route::post('/get_user_answers', [QuestionnairAnswerApiController::class, 'get_user_answers']);
    Route::post('/save_user_answers', [QuestionnairAnswerApiController::class, 'save_user_answers']);
    
    // API route for logout user
    Route::post('/logout', [RegisterController::class, 'logout']);
});

//Route::middleware('auth:sanctum')->post('/user', function (Request $request) {
//    return $request->user();
//});
