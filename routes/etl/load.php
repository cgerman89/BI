<?php
//section load

Route::get('LOAD','Etl\LoadController@index')
    ->name('load.index')
    ->middleware('has.role:load.index');

Route::get('LOAD/{key}/getHtml','Etl\LoadController@getHtmlTable')
    ->name('load.getHtml');

Route::get('LOAD/{key}/getData','Etl\LoadController@getData')
    ->name('load.getData');