<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\IndividualsController;

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


Route::namespace('App\Http\Controllers')->group(function(){

    //Home
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/editProfile/{id}', 'HomeController@editProfile')->name('editProfile');
    Route::post('/update', 'HomeController@updateProfile')->name('updateProfile');

    Route::prefix('permission')->group(function () {
        Route::get('/', 'PermissionController@index')->name('permissionView');
        Route::post('/save_permission', 'PermissionController@savePermission')->name('savePermission');
    });
    Route::get('/viewIndividual/jobList/{indi_id}', 'IndividualsController@viewIndividualJobList' )->name('viewIndividualJobList');
    Route::get('/view/groupList/{id}', 'HomeController@viewGroupList' )->name('viewGroupList');

    Route::group(['middleware' => ['auth', 'user-permission']], function(){
        
        //Employee
        Route::prefix('employee')->group(function () {
            Route::get('/', 'EmployeeController@index')->name('empView');
            Route::post('/saveEmployee', 'EmployeeController@saveEmployee')->name('saveEmployee');
            Route::post('/saveEmployeedashboard', 'EmployeeController@saveEmployee')->name('saveEmployeedashboard');
            Route::get('/viewEmployee/{emp_id}', 'EmployeeController@viewEmployee')->name('viewEmployee');
            Route::get('/deleteEmployee/{emp_id}', 'EmployeeController@deleteEmployee')->name('deleteEmployee');
        });

        //Records
        Route::prefix('records')->group(function () {
            Route::get('/', 'RecordsController@index')->name('recordsView');
            Route::get('/add', 'RecordsController@addRecords')->name('addRecords');
            Route::get('/edit/{rec_id}', 'RecordsController@editRecords')->name('editRecords');
            Route::get('/delete/{rec_id}', 'RecordsController@deleteRecords')->name('deleteRecords');
            Route::post('/save', 'RecordsController@saveFormRecords')->name('saveFormRecords');
            Route::post('/record_save', 'RecordsController@saveRecord')->name('saveRecord');
            Route::get('/generate_pdf/{rec_id}', 'RecordsController@generatePDF')->name('generatePDF');

            Route::post('/share','RecordsController@sharePdf')->name('sharePdf');
        });

        //Individuals
        Route::prefix('individuals')->group(function () {
            Route::get('/', 'IndividualsController@index')->name('individualView');
            Route::post('/saveIndividual', 'IndividualsController@saveIndividual')->name('saveIndividual');
            Route::get('/viewIndividual/{indi_id}', 'IndividualsController@viewIndividual')->name('viewIndividual');
            Route::get('/deleteIndividual/{indi_id}', 'IndividualsController@deleteIndividual')->name('deleteIndividual');
        });

        //Groups
        Route::prefix('groups')->group(function () {
            Route::get('/', 'GroupController@index')->name('groupView');
            Route::get('/viewGroup/{group_id}', 'GroupController@viewGroup')->name('viewGroup');
            Route::post('/saveGroup', 'GroupController@saveGroup')->name('saveGroup');
            Route::get('/edit-student/{group_id}', [GroupController::class, 'edit']);
            Route::put('/updateGroup', 'GroupController@updateGroup')->name('updateGroup');
            Route::get('/delete/{group_id}', 'GroupController@deleteGroup')->name('deleteGroup');
            Route::get('/removeMember/{member_id}', 'GroupController@removeMember')->name('removeMember');
            Route::get('/getIndividuals','GroupController@getIndividuals')->name('getIndividuals');
            Route::get('/getGroups','GroupController@getGroups')->name('getGroups');
        });

        //Settings
        Route::prefix('profile')->group(function () {
            Route::get('/', 'SettingController@profileView')->name('profileView');
            Route::post('/view', 'SettingController@changePassword')->name('changePassword');
        });
    });
});
