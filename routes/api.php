<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('userer','ProfileController@authUser');

Route::group(['namespace'=>'Api'],function () {

    Route::group(['namespace' => 'Auth'], function () {
        Route::post('login', 'LoginController@login');
        Route::post('register', 'RegisterController@register');
//        Route::post('recover_password', 'LoginController@recoverPassword');

    });

});
    Route::group(['middleware'=>'auth:api'],function () {

        //admin
        Route::get('get_all_users','UserController@getAllUsers')->name('get_all_users');
        Route::post('save_new_user','UserController@saveNewUser')->name('save_new_user');
        Route::get('delete_user/{user}','UserController@deleteUser')->name('delete_user');


        //manager

        Route::get('get_all_regular_users','UserController@getAllRegularUsers')->name('get_all_regular_users');
        Route::post('save_new_user','UserController@saveNewUser')->name('save_new_user');
        Route::get('delete_user/{user}','UserController@deleteUser')->name('delete_user');


        //regular user
            Route::get('get_user_tasks','TaskController@getUserTasks')->name('get_user_tasks');
            Route::post('save_new_task','TaskController@saveNewTask')->name('save_new_task');
            Route::get('delete_task/{task}','TaskController@deleteTask')->name('delete_task');
            Route::get('mark_as_complete_task/{task}','TaskController@markAsComplete')->name('mark_as_complete_task');
    });

