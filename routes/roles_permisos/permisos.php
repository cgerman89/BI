<?php
Route::get('permission', 'PermisoController@index')
    ->name('permission.index')
    ->middleware('has.role:permission.index');

Route::get('permission/{id}/edit','PermisoController@edit')
    ->name('permission.edit')
    ->middleware('has.role:permission.edit');

Route::put('permission/{id}','PermisoController@update')
    ->name('permission.update')
    ->middleware('has.role:permission.update');

Route::delete('permission/{id}/destroy','PermisoController@destroy')
    ->name('permission.destroy')
    ->middleware('has.role:permission.destroy');

Route::post('permission/store','PermisoController@store')
    ->name('permission.store')
    ->middleware('has.role:permission.store');

Route::get('permission/getAll','PermisoController@getAll')
    ->name('permission.getAll')
    ->middleware('has.role:permission.getAll');