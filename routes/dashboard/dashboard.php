<?php
/**
 * @author cgerman 2019 mar
 */
Route::get('dashboard/index','dashboard\DashboardController@index')
    ->name('dashboard.index')
    ->middleware('has.role:dashboard.index');

Route::post('dashboard/store','dashboard\DashboardController@store')
    ->name('dashboard.store')
    ->middleware('has.role:dashboard.store');

Route::get('dashboard/allDashboard','dashboard\DashboardController@allDashboard')
    ->name('dashboard.allDashboard')
    ->middleware('has.role:dashboard.allDashboard');

Route::get('dashboard/edit/{id}','dashboard\DashboardController@edit')
    ->name('dashboard.edit')
    ->middleware('has.role:dashboard.edit');

Route::put('dashboard/{id}/update','dashboard\DashboardController@update')
    ->name('dashboard.update')
    ->middleware('has.role:dashboard.update');

Route::delete('dashboard/{id}/delete','dashboard\DashboardController@delete')
    ->name('dashboard.delete')
    ->middleware('has.role:dashboard.delete');

//list dashboard
Route::get('dashboard/list/index','dashboard\ListDashboardController@index')
    ->name('dashboard.list.index')
    ->middleware('has.role:dashboard.list.index');

Route::get('dashboard/list/getGraphic/{id}','dashboard\ListDashboardController@getGraphic')
    ->name('dashboard.list.getGraphic')
    ->middleware('has.role:dashboard.list.getGraphic');
