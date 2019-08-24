<?php

namespace App\Providers;

use App\Connect\Datos;
use App\Connect\OTF;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(){
       $this->app->singleton('App\Connect\Base');
    }
}
