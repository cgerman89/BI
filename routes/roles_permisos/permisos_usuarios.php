<?php

Route::get('permissions/users/index','UserPermissionController@index')
    ->name('permissions.users.index')
    ->middleware('has.role:permissions.users.index');

Route::post('permissions/users/store','UserPermissionController@store')
    ->name('permissions.users.store')
    ->middleware('has.role:permissions.users.store');

Route::get('permissions/users/getAllUsers','UserPermissionController@getAllUsers')
    ->name('permissions.users.getAllUsers')
    ->middleware('has.role:permissions.users.getAllUsers');

Route::get('permissions/users/getRoles','UserPermissionController@getAllRoles')
    ->name('permissions.users.getRoles')
    ->middleware('has.role:permissions.users.getRoles');

Route::get('permissions/users/{user}/getUser','UserPermissionController@getUser')
    ->name('permissions.users.getUser')
    ->middleware('has.role:permissions.users.getUser');

Route::get('permissions/users/{user}/showRoles','UserPermissionController@showRoles')
    ->name('permissions.users.showRoles')
    ->middleware('has.role:permissions.users.showRoles');

Route::delete('permissions/users/{user}/destroy','UserPermissionController@destroy')
    ->name('permissions.users.destroy')
    ->middleware('has.role:permissions.users.destroy');

