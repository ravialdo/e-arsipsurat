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

Route::get('dashboard', 'UserController@dashboard');

Route::get('/', function(){
	return view('auth.login');
});

Route::resource('/dashboard/user', 'UserController');
Route::resource('/dashboard/mail', 'MailController');
Route::get('/dashboard/mail/view/{id}', 'MailController@download');
Route::resource('/dashboard/disposition', 'DispositionController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
