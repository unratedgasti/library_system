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


include_once 'adminRoutes.php';


Route::group(array('middleware'=>'guest'),function(){
	Route::get('/login', function () {
		return view('front/login');
	});
	Route::post('/login', 'LoginController@login');
});

Route::group(array('middleware'=>array('auth','user')),function(){
	
	Route::get('/',['uses'=>'Front\HomeController@index']);

	Route::get('/bookfund',['uses'=>'Front\BookFundController@index']);
	Route::get('/request',['uses'=>'Front\RequestController@index']);
	Route::get('/bookfund/getdata','Front\BookFundController@getFundData');	
	Route::get('/bookfund/bookfunddetails/{id}', [
    'as'   => 'bookfund/bookfunddetails',
    'uses' => 'Front\BookFundController@bookFundDetails'
	]);
	Route::get('/search',['uses'=>'Front\SearchController@index']);
	Route::get('/search/searchresult/{searchdata}/{filterdata}', [
    'as'   => 'search/searchresult',
    'uses' => 'Front\HomeController@searchResult'
	]);
});



Route::group(array('middleware'=>'auth'),function(){
	Route::get('/logout', function(){
		Auth::logout();
		return redirect('/login');
	});
});




