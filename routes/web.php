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
Route::get('/home', 'Backend\HomeController@index')->name('home');


//Login ke halaman
Route::get('/login', 'LoginController@index');
Route::post('/login/validate', 'LoginController@cekLogin');
Route::post('login', [ 'as' => 'login', 'uses' => 'LoginController@cekLogin']);
//Menu backend
Route::group(['middleware' => ['login-verification']], function () {
//    Menu backend
	Route::post('/logout', 'LoginController@cekLogout')->name('logout');
    Route::get('/backend/home', 'LoginController@loginMenu');
    Route::get('/backend/home/sh', 'HomeController@sh');
    Route::post('/uploadfile', 'UploadController@proses_upload')->name('uploadfile');
    Route::get('/upload', function () {
   	 return view('backend.upload');
	})->name('pageupload');
});


