<?php

namespace Fortshpejt\PCB;

use Illuminate\Support\ServiceProvider;

class PcbServiceProvider extends ServiceProvider
{

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
     * Register the application bindings.
     *
     * @return void
     */
    private function registerPcb()
    {
        /*$this->app->singleton('express_checkout', function () {
            return new ExpressCheckout();
        });
        $this->app->singleton('adaptive_payments', function () {
            return new AdaptivePayments();
        });*/
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
