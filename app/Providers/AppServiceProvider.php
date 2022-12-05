<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerServices();
        $this->registerRepository();
    }

    public function registerServices() //user
    {
        $this->app->bind(
            \App\Services\Post\PostService::class,
            \App\Services\Post\PostServiceInterface::class,
        );

        $this->app->bind(
            \App\Services\User\UserService::class,
            \App\Services\User\UserServiceInterface::class,
        );
    }

    public function registerRepository() //admin
    {
        $this->app->bind(
            \App\Repositories\Post\PostReponsitory::class,
            \App\Repositories\Post\PostRepositoryInterFace::class,
        );

        $this->app->bind(
            \App\Repositories\User\UserReponsitory::class,
            \App\Repositories\User\UserRepositoryInterFace::class,
        );

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
