<?php

Route::get('profile/index','ProfileController@index')
     ->name('profile.index');

Route::put('profile/changePwd','ProfileController@ChangePassword')
    ->name('profile.changePwd');