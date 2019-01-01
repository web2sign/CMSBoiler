<?php

Route::group(['middleware' => 'web', 'prefix' => 'auth', 'namespace' => 'Modules\Auth\Http\Controllers'], function()
{
    Route::get('/', 'AuthController@index');
});



Route::group([
	'prefix' => 'api/v1/auth',
	'namespace' => 'Modules\Auth\Http\Controllers'
],function(){

    Route::get('login', [
      'uses' => 'AuthController@postLogin'
    ]);
});