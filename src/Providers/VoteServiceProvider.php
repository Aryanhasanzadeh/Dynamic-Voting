<?php


namespace Aryanhasanzadeh\Voteing\Providers;

use Illuminate\Support\ServiceProvider;

class VoteServiceProvider extends ServiceProvider{

    public function boot()
    {

        $this->mergeConfigFrom(__DIR__.'/../config/VoteManagement.php', 'VoteManager');

        $this->loadRoutesFrom(__DIR__.'/../App/Http/routes/api.php');


        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
        $this->loadFactoriesFrom(__DIR__.'/../../database/factories');

        $this->loadTranslationsFrom(__DIR__.'/../lang', 'Vote');

        $this->publish();

    }


    public function publish()
    {
        $this->publishes([
            __DIR__.'/../config/VoteManagement.php' => config_path('VoteManagement.php'),
        ],'config');

    }

}