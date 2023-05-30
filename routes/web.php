<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\BotManController;
use App\Http\Controllers\BotManController as ControllersBotManController;
use App\Http\Controllers\FrontEnd\FrontEndController;
use Illuminate\Support\Facades\Route;

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



/* BACKEND CONTROLLER - GET METHODS */
Route::get('/admin/login' ,[DashboardController::class,'admin_login'])-> name('admin_login');

Route::middleware(['admin_check'])->group(function () {
    
    Route::get('/dashboard' ,[DashboardController::class,'dashboard'])-> name('dashboard');
    Route::get('/user/list' ,[DashboardController::class,'user_list'])-> name('user_list');
    Route::get('/user/edit/{id}' ,[DashboardController::class,'user_edit'])-> name('user_edit');
    Route::put('/user/update/{id}' ,[DashboardController::class,'user_update'])-> name('user_update');
    Route::get('/user/delete/{id}' ,[DashboardController::class,'user_delete'])-> name('user_delete');
    Route::get('/messages' ,[DashboardController::class,'messages'])-> name('messages');
    Route::get('/messages/list' ,[DashboardController::class,'message_list'])-> name('message_list');
    Route::post('/messages/search/' ,[DashboardController::class,'message_search'])-> name('message_search');
    Route::get('/get_user/{id}' ,[DashboardController::class,'get_user'])-> name('get_user');
    Route::get('/get_convo/{from_id}/{to_id}' ,[DashboardController::class,'get_convo'])-> name('get_convo');
    Route::get('/search/{id}/{value}' ,[DashboardController::class,'search'])-> name('search');
    Route::get('/search_user/{id}/{value}' ,[DashboardController::class,'search_user'])-> name('search_user');
    Route::get('/messages/list/report' ,[DashboardController::class,'message_report'])-> name('message_report');
    Route::get('/profile' ,[DashboardController::class,'admin_profile'])-> name('admin_profile');
});


Route::get('/logout',[DashboardController::class,'logout'])-> name('logout');

/* BACKEND CONTROLLER - POST METHODS */
Route::post('/login',[DashboardController::class,'login'])-> name('login');


Route::match(['get', 'post'], 'botman',[BotManController::class,'handle']);
// Route::get('/login/{id}' ,[DashboardController::class,'user'])-> name('user');
Route::get('order' ,[DashboardController::class,'order'])-> name('order');




/* FRONTEND CONTROLLER - GET METHODS */
Route::get('/',[FrontEndController::class,'welcome'])-> name('welcome');
Route::get('/user/create' ,[FrontEndController::class,'user_create'])-> name('user_create');
Route::get('/user/login' ,[FrontEndController::class,'user_login'])-> name('user_login');
Route::get('/user/dashboard',[FrontEndController::class,'user_dashboard'])-> name('user_dashboard');
Route::get('/user/profile' ,[FrontEndController::class,'user_profile'])-> name('user_profile');

/* FRONTEND CONTROLLER - POST METHODS */
Route::post('/signin',[FrontEndController::class,'signin'])-> name('signin');
Route::post('/registration' ,[FrontEndController::class,'registration'])-> name('registration');

/* FRONTEND CONTROLLER - PUT METHODS */
Route::put('/user/profile/update/{id}' ,[FrontEndController::class,'user_profile_update'])-> name('user_profile_update');



