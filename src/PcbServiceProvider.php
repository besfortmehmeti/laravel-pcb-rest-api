<?php

namespace Fortshpejt\PCB;

use Fortshpejt\PCB\Pcb;

use Illuminate\Support\ServiceProvider;

class PcbServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerPcb();

        $this->mergeConfig();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('pcb.php'),
        ]);
    }


    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerPcb()
    {
        $this->app->singleton('pcb', function () {
            return new Pcb();
        });
    }



    /**
     * Merges user's and pcb's configs.
     *
     * @return void
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php',
            'pcb'
        );
    }


}
