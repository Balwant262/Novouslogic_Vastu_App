<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\RegisterController;
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

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/profile', function(Request $request) {
        return auth()->user();
    });
    
    

    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\Api\RegisterController::class, 'logout']);
});

//Route::middleware('auth:sanctum')->post('/user', function (Request $request) {
//    return $request->user();
//});
