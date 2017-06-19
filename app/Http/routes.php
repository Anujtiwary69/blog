<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	if (!Auth::check() && !Request::is('/login')) {
           return Redirect::to('/login');
           
         }
    return view('welcome',['css'=>'go']);
    
});
Route::post('/search','Controller@searchPost');
Route::get('/pdf','Controller@PDFDownload');
Route::get('/csv','Controller@exportToCSV');
Route::get('/login','Controller@Login');
Route::post('/validate','Controller@checkLogin');
Route::get('/domain','Controller@findDomain');
