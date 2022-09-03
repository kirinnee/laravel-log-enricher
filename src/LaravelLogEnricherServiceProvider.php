<?php

namespace Kirinnee\LaravelLogEnricher;

use Illuminate\Support\ServiceProvider;

class LaravelLogEnricherServiceProvider extends ServiceProvider
{
    /**
     * Publishes configuration file.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/laravel_log_enricher.php' => config_path('laravel_log_enricher.php'),
            ], 'laravel-log-enricher-config');
        }
    }

    /**
     * Make config publishment optional by merge the config from the package.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/laravel_log_enricher.php',
            'laravel_log_enricher'
        );
    }
}
