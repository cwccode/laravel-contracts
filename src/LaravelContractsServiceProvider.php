<?php

namespace CwcCode\LaravelContracts;

use Illuminate\Support\ServiceProvider;

class LaravelContractsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands(ContractMakeCommand::class);
        }
    }
}