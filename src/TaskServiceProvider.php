<?php


namespace SoftDD\Task;


use Illuminate\Support\ServiceProvider;

class TaskServiceProvider  extends ServiceProvider
{
    public function boot()
    {
        $source = realpath($raw = __DIR__.'/../config/softDDTask.php') ?: $raw;
        $this->publishes([$source => config_path('softDDTask.php')]);

        $route = realpath($raw = __DIR__.'/../routes.php') ?: $raw;
        $this->loadRoutesFrom($route);
    }
}
