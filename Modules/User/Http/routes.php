<?php



Route::group([
  'middleware' => 'admin', 
  'prefix' => 'admin', 
  'namespace' => 'Modules\User\Http\Controllers'
], function() {

    Route::get('users', [
      'uses' => 'UserAdminController@index',
      'as' => 'module.admin.user.read',
    ]);

    Route::get('user', [
      'uses' => 'UserAdminController@index',
      'as' => 'module.admin.user.read',
    ]);

    Route::get('user/create', [
      'uses' => 'UserAdminController@create',
      'as' => 'module.admin.user.create',
    ]);

    Route::post('user/create', [
      'uses' => 'UserAdminController@store',
      'as' => 'module.admin.user.create',
    ]);

    Route::get('user/{id}/update', [
      'uses' => 'UserAdminController@edit',
      'as' => 'module.admin.user.update',
    ]);

    Route::post('user/{id}/update', [
      'uses' => 'UserAdminController@update',
      'as' => 'module.admin.user.update',
    ]);

    Route::post('user/{id}/delete', [
      'uses' => 'UserAdminController@destroy',
      'as' => 'module.admin.user.delete'
    ]);
});
