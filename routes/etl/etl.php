<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 12/12/2018
 * Time: 9:19
 */

Route::get('Etl','Etl\EtlController@index')
    ->name('Etl.index')
    ->middleware('has.role:etl.index','connection:etl.index');

Route::get('ETL/COLLECTION','Etl\EtlCollectionController@index')
    ->name('etl.collection.index')
    ->middleware('has.role:etl.collection.index');

Route::get('ETL/GET/COLLECTION','Etl\EtlCollectionController@getRegisters')
    ->name('ETL.GET.COLLECTION');

Route::get('ETL/GET/INFO/{key}/COLLECTION','Etl\EtlCollectionController@getInfo')
    ->name('ETL.GET.INFO.COLLECTION');

Route::get('ETL/GET/DEL/{id_key}/{name_key}/COLLECTION','Etl\EtlCollectionController@destroy')
    ->name('ETL.GET.DEL.COLLECTION');

Route::get('ETL/{schema}/{table}/HtmlTablePreview','Etl\EtlController@HtmlTablePreview')
    ->name('ETL.HtmlTablePreview');


