<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 10/12/2018
 * Time: 15:43
 */

Route::get('Connections','DataSource\Connection@index')
    ->name('Connections.index')
    ->middleware('has.role:Connections.index');

Route::get('Connections/{id}/Connect','DataSource\Connection@Connect')
    ->name('Connections.Connect');

Route::post('Connections/store','DataSource\Connection@store')
    ->name('Connections.store')
    ->middleware('has.role:Connections.store');

Route::get('Connections/{id}/edit','DataSource\Connection@edit')
    ->name('Connections.edit')
    ->middleware('has.role:Connections.edit');

Route::put('Connections/{id}','DataSource\Connection@update')
    ->name('Connections.update')
    ->middleware('has.role:Connections.update');

Route::delete('Connections/{id}/delete','DataSource\Connection@destroy')
    ->name('Connections.destroy')
    ->middleware('has.role:Connections.destroy');

Route::get('Connections/get_data','DataSource\Connection@get_data')
    ->name('Connections.get_data')
    ->middleware('has.role:Connections.get_data');

Route::get('Connections/get_info','DataSource\Connection@GetInfoConnect')
    ->name('Connections.get_info');