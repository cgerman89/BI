<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 22/11/2018
 * Time: 15:44
 */


Route::get('graphic/index','Graficos\GraficosController@index')
    ->name('graphic.index')
    ->middleware('has.role:graphic.index');

Route::get('graphic/Bar/{id}/COLUMNS','Graficos\GraficosController@GetEtl')
    ->name('graphic.COLUMNS');

Route::get('graphic/Bar/KEY/ETL','Graficos\GraficosController@GetKeyEtl')
    ->name('graphic.GetKeyEtl');

Route::get('graphic/{key}/{ejeY}/{ejeX}/{option}/{type}/{title}/{datasetTitle}/getData','Graficos\GraficosController@getData')
    ->name('graphic.getData');

Route::get('graphic/getOperaciones','Graficos\GraficosController@getOperaciones')
    ->name('graphic.getOperaciones');

Route::get('graphic/getPdf','Graficos\GraficosController@getPdf')
    ->name('graphic.getPdf');

Route::get('graphic/getAllDashboard','Graficos\GraficosController@getAllDashboard')
    ->name('graphic.getAllDashboard');

Route::get('graphic/getDescriptionDashboard/{id}','Graficos\GraficosController@getDescriptionDashboard')
    ->name('graphic.getDescriptionDashboard');

Route::post('graphic/store','Graficos\GraficosController@store')
    ->name('graphic.store')
    ->middleware('has.role:graphic.store');

//list routers
Route::get('graphic/getList/index','Graficos\GraficosListController@index')
    ->name('graphic.getList.index')
    ->middleware('has.role:graphic.getList.index');

Route::get('graphic/getList/AllGraphic','Graficos\GraficosListController@getAllGraphic')
    ->name('graphic.getList.AllGraphic');

Route::delete('graphic/getList/{id}/delete','Graficos\GraficosListController@delete')
    ->name('graphic.getList.delete');