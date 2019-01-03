<?php

Route::group([
  'middleware' => 'admin', 
  'prefix' => 'admin', 
  'namespace' => 'Modules\Admin\Http\Controllers'],
  function() {

    Route::get('/',function(){
      redirect()->to('admin/dashboard')->send();
    });
    
    Route::get('dashboard', [
      'uses' => 'DashboardController@index',
      'as' => 'module.admin.dashboard.read'
    ]);
    

    /* PAGE ROUTES */
    Route::get('pages', [
      'uses' => 'PageController@index',
      'as' => 'module.admin.page.read',
      'post_type' => 'page'
    ]);

    Route::get('page', [
      'uses' => 'PageController@index',
      'as' => 'module.admin.page.read',
      'post_type' => 'page'
    ]);

    Route::get('page/create', [
      'uses' => 'PageController@create',
      'as' => 'module.admin.page.create',
      'post_type' => 'page'
    ]);

    Route::post('page/create', [
      'uses' => 'PageController@store',
      'as' => 'module.admin.page.create',
      'post_type' => 'page'
    ]);

    Route::get('page/{id}/update', [
      'uses' => 'PageController@edit',
      'as' => 'module.admin.page.update',
      'post_type' => 'page'
    ]);

    Route::post('page/{id}/update', [
      'uses' => 'PageController@update',
      'as' => 'module.admin.page.update',
      'post_type' => 'page'
    ]);

    Route::post('page/{id}/delete', [
      'uses' => 'PageController@destroy',
      'as' => 'module.admin.page.delete'
    ]);
    /* PAGE ROUTES */

  }
);



Route::group([
  'middleware' => ['web'], 
  'prefix' => 'admin', 
  'namespace' => 'Modules\Admin\Http\Controllers'], 
  function() {
    Route::get('logout','LoginController@getLogout');
    Route::get('login', 'LoginController@getLogin');
    Route::post('login', 'LoginController@postLogin');
  }
);