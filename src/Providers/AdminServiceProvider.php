<?php

namespace Bavix\Providers;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{

    public function boot()
    {
        if ($this->app->runningInConsole())
        {
            $this->publishes([
                \dirname(__DIR__, 2) . '/resources/lang' => resource_path('lang')],
                'laravel-helpers-lang'
            );
        }
    }

}
