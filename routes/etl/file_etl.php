<?php
Route::get('Etl/file','Etl\FileController@index')
    ->name('etl.file.index')
    ->middleware('has.role:etl.file.index');

Route::post('Etl/file/import','Etl\FileController@importFile')
    ->name('etl.file.import');

Route::post('Etl/file/store','Etl\FileController@store')
    ->name('etl.file.store');

Route::get('Etl/file/getData','Etl\FileController@getData')
    ->name('etl.file.getData');
