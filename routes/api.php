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
Route::post('getAdmin/{admin_id}', 'AdminController2@getAdmin');
Route::post('createProject', 'ProjectController@createProject');

Route::get('getProviders', 'UserController@getProviders');
Route::get('getBillings', 'BillingController@getBillings');
Route::get('getBillingsDash', 'BillingController@getBillingsDash');
Route::get('getBillingsDashProvider', 'BillingController@getBillingsDashProvider');
Route::post('getBillingsWhere/{year}/{month}', 'BillingController@getBillingsWhere');
Route::post('getBillingsByUser/{user_id}', 'BillingController@getBillingsByUser');
Route::post('getBilling/{billing_id}', 'BillingController@getBilling');
Route::post('getNotifications/{user_id}/{who}', 'NotificationController@getNotifications');
Route::post('getProjects/{user_id}', 'ProjectController@getProjects');
Route::post('getProjectName/{user_id}', 'ProjectController@getProjectName');
Route::post('getClientName/{user_id}', 'ProjectController@getClientName');
Route::post('getProject/{project_id}', 'ProjectController@getProject');
Route::post('deleteNotifications/{admin_id}/{who}', 'NotificationController@deleteNotifications');
Route::post('getCommission/{project_id}', 'CommissionController@getCommission');
Route::post('getCommissionRate/{project_id}', 'CommissionController@getCommissionRate');
Route::post('getCommissionValue/{project_id}', 'CommissionController@getCommissionValue');
Route::post('getCommissionsByProject/{project_id}', 'CommissionController@getCommissionsByProject');
Route::post('getNotificationsCount/{user_id}/{who}', 'NotificationController@getNotificationsCount');
Route::post('getProjectsCount/{user_id}', 'UserController@getProjectsCount');
Route::get('getProjectsCountDash', 'ProjectController@getProjectsCountDash');
Route::post('getProjectsCountPro/{id_provider}', 'ProjectController@getProjectsCountPro');
Route::post('getProjectsCountProDone/{id_provider}', 'BillingController@getProjectsCountProDone');
Route::post('setSeen/{user_id}/{who}', 'NotificationController@setSeen');
Route::post('changePassword/{user_id}', 'UserController@changePassword');
Route::post('changePasswordAdmin/{user_id}', 'AdminController2@changePasswordAdmin');
Route::post('changePasswordConfirmation/{user_id}', 'UserController@changePasswordConfirmation');
Route::post('changePasswordConfirmationAdmin/{admin_id}', 'UserController@changePasswordConfirmationAdmin');
Route::post('updateProvider/{user_id}', 'UserController@updateProvider');
Route::post('getProvider/{user_id}', 'UserController@getProvider');
Route::post('getProviderName/{user_id}', 'UserController@getProviderName');
Route::post('updateImage/{user_id}', 'UserController@updateImage');
Route::post('updateTransfer/{transfer_id}/{payment_id}', 'TransferController@updateTransfer');
Route::post('updateImageAdmin/{admin_id}', 'AdminController2@updateImageAdmin');
Route::post('getExpenses/{user_id}/{project_id}', 'ExpenseController@getExpenses');
Route::post('addExpense/{user_id}/{project_id}', 'ExpenseController@addExpense');
Route::post('acceptOrRefuseExpense/{expense_id}/{value}/{project_id}', 'ExpenseController@acceptOrRefuseExpense');
Route::post('deleteExpense/{expense_id}/{user_id}', 'ExpenseController@deleteExpense');
Route::post('deleteCommission/{commission_id}', 'CommissionController@deleteCommission');
Route::post('addCommission/{project_id}', 'CommissionController@addCommission');
Route::post('changeFile/{expense_id}/{user_id}', 'ExpenseController@changeFile');
Route::post('addTransfer/{payment_id}', 'TransferController@addTransfer');
Route::post('removeTransfer/{transfer_id}', 'TransferController@removeTransfer');
Route::post('createBilling/{project_id}/{provider_id}', 'BillingController@createBilling');
Route::post('getTransfers/{payment_id}', 'TransferController@getTransfers');
Route::post('getPayment/{billing_id}', 'PaymentController@getPayment');
Route::post('getBillingsByStatus/{status}', 'BillingController@getBillingsByStatus');
Route::get('getBillingsOrderBy', 'BillingController@getBillingsOrderBy');
Route::post('getCalendars/{user_id}/{year}/{month}', 'CalendarController@getCalendars');
Route::post('addToCalendar/{id_project}/{year}/{month}/{day}', 'CalendarController@addToCalendar');
Route::post('getAverageDailyRate/{id_project}', 'CalendarController@getAverageDailyRate');
Route::post('deleteCalendar/{id_calendar}', 'CalendarController@deleteCalendar');
Route::post('getCalendarsId/{id_project}', 'CalendarController@getCalendarsId');
Route::post('isAvailableCalendar/{start}/{end}/{id_project}', 'CalendarController@isAvailableCalendar');
Route::get('getTotalSales', 'BillingController@getTotalSales');
Route::post('updateClientAmount/{billing_id}', 'BillingController@updateClientAmount');
Route::post('addingCom/{project_id}', 'CommissionController@addingCom');

Route::get('getPro', 'ProjectController@getPro'); // added


// adding an user into the database
Route::apiResources(['user'=> 'API\userController']);
Route::apiResources(['project'=> 'API\ProjectController']);
Route::apiResources(['commission'=> 'API\CommissionController']);
Route::apiResources(['admin'=> 'API\AdminController']);

Route::get('showUsers', 'UserController@showUsers');
Route::get('showProjects', 'ProjectController@showProjects');
Route::get('showCommissions', 'CommissionController@showCommission');
Route::get('showAdmins', 'AdminController2@showAdmins');


Route::get('findUser', 'Api\UserController@search');
Route::get('findProject', 'Api\ProjectController@search');
Route::get('findProject', 'Api\AdminController@search');
Route::get('findCommission', 'Api\CommissionController@search');
Route::post('updateCommission/{commission_id}', 'Api\CommissionController@update');
Route::post('createCommission/{idProject}', 'Api\CommissionController@createCommission');

