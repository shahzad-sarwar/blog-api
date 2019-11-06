<?php

namespace App\Providers;

use App\Models\Post;
use App\Observers\Post\PostObserver;
use App\Observers\User\UserObserver;
use App\User;
use Illuminate\Support\ServiceProvider;

class EloquentEventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Post::observe(PostObserver::class);
    }
}
