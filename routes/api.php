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

Route::post('addUser', 'UserController@addUser');
Route::post('addAdmin', 'AdminController2@addAdmin');
Route::post('updateAdmin/{admin_id}', 'AdminController2@updateAdmin');
Route::post('createProject', 'ProjectController@createProject');

Route::get('getProviders', 'UserController@getProviders');
Route::post('getNotifications/{user_id}', 'NotificationController@getNotifications');
Route::post('getProjects/{user_id}', 'ProjectController@getProjects');
Route::post('getNotificationsCount/{user_id}', 'NotificationController@getNotificationsCount');
Route::post('setSeen/{user_id}', 'NotificationController@setSeen');
