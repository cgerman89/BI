<?php
/**
 * Created by PhpStorm.
 * User: Asus-PC
 * Date: 23/1/2019
 * Time: 11:12
 */

//extract
Route::post('EXT/Extract','Etl\ExtractController@Extract')
    ->name('EXT.Extract');
Route::get('EXT/Lista','Etl\ExtractController@CacheLista')
    ->name('EXT.Lista');

