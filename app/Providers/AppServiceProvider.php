<?php

namespace App\Providers;

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
    public function register()
    {
        //
      $this->app->bind('App\Repositories\IEtudiantRepository','App\Repositories\EtudiantRepository');
      $this->app->bind('App\Repositories\IExamenRepository','App\Repositories\ExamenRepository');
      $this->app->bind('App\Repositories\IBeaconRepository','App\Repositories\BeaconRepository');
      
    }
}
