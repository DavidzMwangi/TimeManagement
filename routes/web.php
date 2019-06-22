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

        Route::get('de_activate_user/{user}','UserController@deActivateUser')->name('de_activate_user');
        Route::get('activate_user/{user}','UserController@activateUser')->name('activate_user');
    });


    //manage routes
    Route::group(['middleware'=>['role:Manager'],'prefix'=>'manager','as'=>'manager.'],function () {

        Route::get('manage_users','UserController@manageUsersView')->name('manage_users');
        Route::get('get_all_regular_users','UserController@getAllRegularUsers')->name('get_all_regular_users');
        Route::post('save_new_user','UserController@saveNewUser')->name('save_new_user');
        Route::get('delete_user/{user}','UserController@deleteUser')->name('delete_user');
        Route::get('de_activate_user/{user}','UserController@deActivateUser')->name('de_activate_user');
        Route::get('activate_user/{user}','UserController@activateUser')->name('activate_user');

    });


    //regular user routes
    Route::group(['middleware'=>['role:RegularUser'],'prefix'=>'user','as'=>'user.'],function () {
    Route::get('tasks','TaskController@taskView')->name('tasks');
    Route::get('get_user_tasks','TaskController@getUserTasks')->name('get_user_tasks');
    Route::post('save_new_task','TaskController@saveNewTask')->name('save_new_task');
    Route::get('delete_task/{task}','TaskController@deleteTask')->name('delete_task');
    Route::get('mark_as_complete_task/{task}','TaskController@markAsComplete')->name('mark_as_complete_task');


    //profile
    });


    //for general routes that do not need specific role and permission
    Route::post('update_profile','ProfileController@updateProfile')->name('update_profile');
    Route::get('auth_user','ProfileController@authUser')->name('auth_user');
    Route::get('get_all_tasks','TaskController@getAllTasks')->name('get_all_tasks');
    Route::get('tasks_view','TaskController@tasksView')->name('tasks_view');
    Route::get('profile','ProfileController@profileView')->name('profile');

});
