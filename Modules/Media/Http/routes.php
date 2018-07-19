<?php



Route::group([
  'middleware' => 'admin', 
  'prefix' => 'admin', 
  'namespace' => 'Modules\Media\Http\Controllers'
], function() {

    Route::get('media/files', [
      'uses' => 'MediaController@index',
      'as' => 'module.admin.media.read'
    ]);

    Route::post('media/uploads', [
      'uses' => 'MediaController@store',
      'as' => 'module.admin.media.create'
    ]);

    Route::get('media/file/{id}', [
      'uses' => 'MediaController@info',
      'as' => 'module.admin.media.read'
    ]);
});



  Route::get('media/thumbnail/{id}', [
    'uses' => 'Modules\Media\Http\Controllers\MediaController@show',
  ]);
