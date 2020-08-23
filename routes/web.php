<?php

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

// Dashboard Page
Route::get('/',"InboxController@index");

// Activity Page
Route::get('/activities',"ActivityController@index");

// Sync Mail Feature
Route::get('/syncMails',"MailController@syncMails");

Route::post('/mail/delete',"MailController@deleteMail");
