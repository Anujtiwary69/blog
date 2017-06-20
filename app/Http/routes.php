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

Route::get('/', function (Request $request) {

    return view('login/login',['css'=>'go']);
    
});
Route::get('/welcome',function(){
	  return view('welcome1',['css'=>'go']);
});
Route::get('/search','Controller@searchPost');
Route::get('/pdf','Controller@PDFDownload');
Route::get('/csv','Controller@exportToCSV');
Route::get('/login','Controller@Login');
Route::post('/validate','Controller@checkLogin');
Route::get('/domain','Controller@findDomain');
Route::get('/searchDomain','Controller@findDomain');
Route::get('/pdfD','Controller@PDFDownloadD');
Route::get('/csvD','Controller@exportToCSVD');
Route::get('/product',function(){
	  return view('welcome',['css'=>'go']);
});
Route::get('/save','Controller@SaveToDB');
Route::get('/SaveD','Controller@SaveDToDB');
