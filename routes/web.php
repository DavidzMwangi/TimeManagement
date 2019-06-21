<?php

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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('homepage',function (){
   return view('backend.layouts.master');
});

Route::group(['middleware'=>'auth'],function (){

    //admin routes
    Route::group(['middleware'=>['role:Admin'],'prefix'=>'admin','as'=>'admin.'],function () {

        Route::group(['prefix'=>'roles_permissions','as'=>'roles_permissions.'],function (){
            Route::get('index','RolesPermissionController')->name('index');
            Route::get('permission_roles','RolesPermissionController')->name('permission_roles');
            Route::post('get_other_permissions','RolesPermissionController@getOtherPermissions')->name('get_other_permissions');
            Route::post('get_active_permissions','RolesPermissionController@getActivePermissions')->name('get_active_permissions');
            Route::post('update_permission_to_roles','RolesPermissionController@updatePermissionRole')->name('update_permission_to_roles');
            Route::post('update_revokement_to_rules','RolesPermissionController@revokePermissionToRole')->name('update_revokement_to_rules');

        });


        Route::get('users','UserController@userView')->name('users');
        Route::get('get_all_users','UserController@getAllUsers')->name('get_all_users');
        Route::post('save_new_user','UserController@saveNewUser')->name('save_new_user');
        Route::get('delete_user/{user}','UserController@deleteUser')->name('delete_user');
    });


    //manage routes
    Route::group(['middleware'=>['role:Manager'],'prefix'=>'manager','as'=>'manager.'],function () {

        Route::get('users','UserController@userView')->name('users');

    });


    //regular user routes
    Route::group(['middleware'=>['role:RegularUser'],'prefix'=>'user','as'=>'user.'],function () {


    });


    //for general routes that do not need specific role and permission

});
