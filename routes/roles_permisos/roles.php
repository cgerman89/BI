<?php

Route::get('roles','RolController@index')
    ->name('roles.index')
    ->middleware('has.role:roles.index');

Route::get('roles/getAllPermission','RolController@getAllPermission')
    ->name('roles.getAllPermission')
    ->middleware('has.role:roles.getAllPermission');

Route::post('roles/store','RolController@store')
    ->name('roles.store')
    ->middleware('has.role:roles.store');

Route::get('roles/{rol}/edit','RolController@edit')
    ->name('roles.edit')
    ->middleware('has.role:roles.edit');

Route::put('roles/{rol}','RolController@update')
    ->name('roles.update')
    ->middleware('has.role:roles.update');

Route::delete('roles/{id}/destroy','RolController@destroy')
    ->name('roles.destroy')
    ->middleware('has.role:roles.destroy');

Route::get('roles/{rol}/getPermissions','RolController@getRolPermissions')
    ->name('roles.getPermissions')
    ->middleware('has.role:roles.getPermissions');

Route::get('roles/getAll','RolController@getAll')
    ->name('roles.getAll')
    ->middleware('has.role:roles.getAll');