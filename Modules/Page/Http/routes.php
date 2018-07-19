<?php

Route::group(['middleware' => 'web', 'prefix' => 'page', 'namespace' => 'Modules\Page\Http\Controllers'], function()
{
    Route::get('/', 'PageController@index');
});
