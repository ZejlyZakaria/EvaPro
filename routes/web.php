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

use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});

// Routes for Vuejs (ADMIN)
Route::get('/billings', 'AdminController@index')->name('admin.dashboard');
Route::get('/collaborators', 'AdminController@index')->name('admin.dashboard');
Route::get('/addprovider', 'AdminController@index')->name('admin.dashboard');
Route::get('/createproject', 'AdminController@index')->name('admin.dashboard');
Route::get('/profil', 'AdminController@index')->name('admin.dashboard');
Route::get('/addadmin', 'AdminController@index')->name('admin.dashboard');
Route::get('/profil', 'AdminController@index')->name('admin.dashboard');
Route::get('/test', 'AdminController@index')->name('admin.dashboard');
Route::get('/newbillings', 'AdminController@index')->name('admin.dashboard');
Route::get('/newprofil', 'AdminController@index')->name('admin.dashboard');
Route::get('/providers', 'AdminController@index')->name('admin.dashboard');
Route::get('/projects', 'AdminController@index')->name('admin.dashboard');
Route::get('/encours', 'AdminController@index')->name('admin.dashboard');
Route::get('/paiements', 'AdminController@index')->name('admin.dashboard');
Route::get('/admins', 'AdminController@index')->name('admin.dashboard');
Route::get('/commissions', 'AdminController@index')->name('admin.dashboard');
// End Routes fue Vuejs

// Routes for Vuejs (USER)
Route::get('/myprojects', 'HomeController@index')->name('home');
Route::get('/myprofil', 'HomeController@index')->name('home');
Route::get('/reportwork', 'HomeController@index')->name('home');
Route::get('/newreportwork', 'HomeController@index')->name('home');
Route::get('/mybillings', 'HomeController@index')->name('home');
Route::get('/myexpenses', 'HomeController@index')->name('home');
Route::get('/mydashboard', 'HomeController@index')->name('home');
// End Routes fue Vuejs

Route::get('send','MailController@mailsend');

// admin
Route::prefix('admin')->group(function(){
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/','AdminController@index')->name('admin.dashboard');

    // password reset routes
    Route::post('password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/reset', 'Auth\AdminResetPasswordController@reset');
    Route::get(' password/reset/{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');
});

Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get(' password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');




Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');



Route::get('profile', function () {
    // Only verified users may enter...
})->middleware('verified');

Route::get('dashboard', function () {
    return '/dashboard';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
