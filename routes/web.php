<?php
//DB::listen(function($query){ echo "<pre> {$query->sql } </pre>"; });
// login , logout and routes
Route::get('/', 'Auth\LoginController@showLoginForm')
    ->name('session');

Route::post('/login', 'Auth\LoginController@login')
    ->name('login');

Route::post('/logout', 'Auth\LoginController@logout')
    ->name('logout');

//app routes
Route::middleware(['auth'])->group(function (){
      require __DIR__.'/home/home.php';
      require __DIR__.'/datasource/datasource.php';
      require __DIR__.'/dashboard/dashboard.php';
      require __DIR__.'/query/query.php';
      require __DIR__.'/dbc/dbc.php';
      require __DIR__.'/etl/etl.php';
      require __DIR__.'/etl/file_etl.php';
      require __DIR__.'/etl/extract.php';
      require __DIR__.'/etl/transformer.php';
      require __DIR__.'/etl/load.php';
      require __DIR__.'/graficos/graficos.php';
      require __DIR__.'/user/user.php';
      require __DIR__.'/user/profile.php';
      require __DIR__.'/roles_permisos/roles.php';
      require __DIR__.'/roles_permisos/permisos.php';
      require __DIR__.'/roles_permisos/permisos_usuarios.php';
});




