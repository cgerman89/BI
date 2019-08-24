<?php
//routes the users
Route::get('users','UserController@index')
    ->name('users.index')
    ->middleware('has.role:users.index');

Route::get('users/{user}/edit','UserController@edit')
    ->name('users.edit')
    ->middleware('has.role:users.edit');

Route::delete('users/{user}/destroy','UserController@destroy')
    ->name('users.destroy')
    ->middleware('has.role:users.destroy');

Route::post('users/store','UserController@store')
    ->name('users.store')
    ->middleware('has.role:users.store');

Route::get('users/getAll','UserController@getAllUsers')
    ->name('users.getAll')
    ->middleware('has.role:users.getAll');

Route::put('users/{user}','UserController@update')
    ->name('users.update')
    ->middleware('has.role:users.update');

Route::get('users/{user}/resetPwd','UserController@resetPassword')
    ->name('users.resetPwd')
    ->middleware('has.role:users.resetPwd');