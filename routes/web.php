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
    Route::get('/backend/home/sh', 
    	'HomeController@sh');
    Route::post('/uploadfile', 'UploadController@proses_upload')->name('uploadfile');
    Route::get('/upload', function () {
   	 return view('backend.upload');
	})->name('pageupload');
    // Route::get('/upload', 'UploadController@upload')->name('uploadfile');

    Route::get('/schema','UploadController@schem');

	Route::get('/user','UserController@index');
	Route::post('/user/create','UserController@create');
	Route::get('/user/edit/{user_id}','UserController@edit');
	Route::post('/user/update/{user_id}','UserController@update');
	Route::get('/user/delete/{user_id}','UserController@delete');

	Route::get('/pdf','PdfController@index');
	Route::get('/pdf/edit/{id_pdf}','PdfController@edit');
	Route::post('/pdf/update/{id_pdf}','PdfController@update');
	Route::get('/pdf/delete/{id_pdf}','PdfController@delete');

	Route::get('/map','MapController@index');
});


