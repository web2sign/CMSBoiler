<?php



Route::group([
  'middleware' => 'admin', 
  'prefix' => 'admin', 
  'namespace' => 'Modules\User\Http\Controllers'
], function() {

    Route::get('users', [
      'uses' => 'UserController@index',
      'as' => 'module.admin.user.read',
    ]);

    Route::get('user', [
      'uses' => 'UserController@index',
      'as' => 'module.admin.user.read',
    ]);

    Route::get('user/create', [
      'uses' => 'UserController@create',
      'as' => 'module.admin.user.create',
    ]);

    Route::post('user/create', [
      'uses' => 'UserController@store',
      'as' => 'module.admin.user.create',
    ]);

    Route::get('user/{id}/update', [
      'uses' => 'UserController@edit',
      'as' => 'module.admin.user.update',
    ]);

    Route::post('user/{id}/update', [
      'uses' => 'UserController@update',
      'as' => 'module.admin.user.update',
    ]);

    Route::post('user/{id}/delete', [
      'uses' => 'UserController@destroy',
      'as' => 'module.admin.user.delete'
    ]);
});
