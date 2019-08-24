<?php
//section transformer
Route::get('TRNF','Etl\TransformationController@index')
       ->name('trnf.index')
       ->middleware('has.role:trnf.index');

Route::get('TRNF/{clave}/ColumnsDataCache','Etl\TransformationController@ColumnsDataCache')
    ->name('trnf.columnsDataCache');

Route::post('TRNF/TransformerData','Etl\TransformationController@TransformerData')
    ->name('trnf.TransformerData');

Route::get('TRNF/{key}/GetDataTable','Etl\TransformationController@GetDataTable')
    ->name('Transformer.GetDataTable');