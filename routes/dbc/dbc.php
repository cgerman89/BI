<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 12/12/2018
 * Time: 9:24
 */
Route::get('DBC/GetDBMS','DatabaseController@GetDBMS');

Route::get('DBC/GetSchemas','DatabaseController@GetSchemas')
    ->name('DBC.GetSchemas');

Route::get('DBC/{schema}/GetTables','DatabaseController@GetTables')
    ->name('DBC.GetTables');

Route::get('DBC/GetOperation','DatabaseController@GetOperation')
    ->name('DBC.GetOperation');

Route::get('DBC/{schema}/{table}/GetColumns','DatabaseController@GetColumns')
    ->name('DBC.GetColumns');

Route::get('DBC/{schema}/{table}/getDataPreview','DatabaseController@getDataPreview')
    ->name('DBC.getDataPreview');