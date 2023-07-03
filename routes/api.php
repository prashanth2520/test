<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();

// });

Route::namespace('App\Http\Controllers\Api')->group(function(){
    Route::prefix('apigroup')->group(function () {
        Route::get('/', 'EmployeeController@index')->name('employeeView');
    });
    Route::get('/', 'PermissionController@index')->name('permissionView');
});

Route::post('login', [UserController::class,'login']);
Route::post('forgot-password', [UserController::class,'forgotPassword']);

Route::group(['middleware' => ['auth:api']], function () {

Route::post('changePassword', [UserController::class,'changePassword']);

Route::post('profile/edit', [UserController::class, 'updateProfile']);   //EDIT PROFILE

Route::get('get-profile', [UserController::class,'getProfile']);   //GET PROFILE

Route::post('home', [UserController::class,'home']);   //HOME

Route::get('search', [UserController::class,'searchRoute']); //SEARCH ROUTE

Route::get('group/create', [UserController::class,'createGroup']); //SEARCH ROUTE

Route::get('records', [UserController::class,'records_listing']);

Route::get('individuals',[UserController::class,'individuals_listing']);

Route::get('groups',[UserController::class,'groups_listing']);

});
