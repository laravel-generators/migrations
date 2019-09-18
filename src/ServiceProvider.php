<?php


namespace LaravelGenerators\Migrations;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerPublish();
        }
    }

    public function register()
    {
        $configPath = __DIR__.'/../config/generators-migrations.php';
        $this->mergeConfigFrom($configPath, 'generators-migrations');

        $this->commands([
            Console\GenerateMigrationsCommand::class,
        ]);
    }

    protected function registerPublish()
    {
        $configPath = __DIR__.'/../config/generators-migrations.php';
        if (function_exists('config_path')) {
            $publishPath = config_path('generators-migrations.php');
        } else {
            $publishPath = base_path('config/generators-migrations.php');
        }

        $this->publishes([$configPath => $publishPath], 'config');
    }
}
