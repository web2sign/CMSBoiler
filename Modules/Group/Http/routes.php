<?php
Route::group([
  'middleware' => 'admin', 
  'prefix' => 'admin', 
  'namespace' => 'Modules\Group\Http\Controllers'
], function() {

    Route::get('groups', [
      'uses' => 'GroupAdminController@index',
      'as' => 'module.admin.group.read',
    ]);

    Route::get('group', [
      'uses' => 'GroupAdminController@index',
      'as' => 'module.admin.group.read',
    ]);

    Route::get('group/create', [
      'uses' => 'GroupAdminController@create',
      'as' => 'module.admin.group.create',
    ]);

    Route::post('group/create', [
      'uses' => 'GroupAdminController@store',
      'as' => 'module.admin.group.create',
    ]);

    Route::get('group/{id}/update', [
      'uses' => 'GroupAdminController@edit',
      'as' => 'module.admin.group.update',
    ]);

    Route::post('group/{id}/update', [
      'uses' => 'GroupAdminController@update',
      'as' => 'module.admin.group.update',
    ]);

    Route::post('group/{id}/delete', [
      'uses' => 'GroupAdminController@destroy',
      'as' => 'module.admin.group.delete'
    ]);
});
