<?php

namespace App\Providers;

use App\User;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    private $models = [
        'User'
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->models as $model) {
            $this->app->bind(
                "App\Repositories\Interfaces\\{$model}RepositoryInterface",
                "App\Repositories\Eloquents\\{$model}Repository"
            );
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
