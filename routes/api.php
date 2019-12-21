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


Route::post('/login', [
	'as' 	=> 'auth.login',
	'uses' 	=> 'Api\AuthController@login'
]);

Route::get('/check', [
	'as' 	=> 'auth.check',
	'uses' 	=> 'Api\AuthController@check'
]);

Route::post('/refresh', [
	'as' 	=> 'auth.refresh',
	'uses' 	=> 'Api\AuthController@refresh'
]);
