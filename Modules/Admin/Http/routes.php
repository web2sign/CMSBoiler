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
    
    Route::get('pages', [
      'uses' => 'PageController@index',
      'as' => 'module.admin.page.read'
    ]);

    Route::get('pages/{page}', [
      'uses' => 'PageController@index',
      'as' => 'module.admin.page.read'
    ]);

    Route::get('page', [
      'uses' => 'PageController@index',
      'as' => 'module.admin.page.read'
    ]);

    Route::get('page/create', [
      'uses' => 'PageController@create',
      'as' => 'module.admin.page.create'
    ]);

    Route::post('page/create', [
      'uses' => 'PageController@store',
      'as' => 'module.admin.page.create'
    ]);

    Route::get('page/{id}/update', [
      'uses' => 'PageController@edit',
      'as' => 'module.admin.page.update'
    ]);

    Route::post('page/{id}/update', [
      'uses' => 'PageController@update',
      'as' => 'module.admin.page.update'
    ]);

    Route::post('page/{id}/delete', [
      'uses' => 'PageController@delete',
      'as' => 'module.admin.page.delete'
    ]);

  }
);



Route::group([
  'middleware' => 'web', 
  'prefix' => 'admin', 
  'namespace' => 'Modules\Admin\Http\Controllers'], 
  function() {

    Route::get('login', [
      'as'    => 'module.admin.login',
      'uses' => 'LoginController@getLogin'
    ]);

    Route::post('login', [
      'as'        => 'module.admin.login',
      'uses'      => 'LoginController@postLogin'
    ]);
  }
);