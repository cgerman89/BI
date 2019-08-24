<?php

Route::get('/home', 'HomeController@index')
    ->name('home');

Route::get('/home/dashboard/{id}/list','HomeController@getGraphic')
    ->name('home.dashboard.list')
    ->middleware('connection:home.dashboard.list');