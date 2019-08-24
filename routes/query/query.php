<?php
/**
 * Created by PhpStorm.
 * User: Cristian
 * Date: 12/12/2018
 * Time: 9:21
 */
Route::get('Query','DataSource\QueryController@index')->name('Query.index');
Route::get('Query/getData','DataSource\QueryController@getData')->name('Query.getData');
Route::get('Query/{id}/ConnDb','DataSource\QueryController@ConnDb')->name('Query.ConnDb');
Route::get('Query/GetSchemas','DataSource\QueryController@GetSchemas')->name('Query.GetSchemas');
Route::get('Query/{schema}/GetTables','DataSource\QueryController@GetTables')->name('Query.GetTables');
Route::get('Query/{schema}/{table}/{operation}/{fields}/TransformerData','DataSource\QueryController@TransformerData')->name('Query.TransformerData');
Route::get('Query/Disconnect','DataSource\QueryController@Disconnect')->name('Query.Disconnect');
Route::get('Query/GetRowsTable','DataSource\QueryController@GetRowsTable')->name('Query.GetRowsTable');