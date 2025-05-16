<?php

namespace App\Providers;

use App\Models\JobTitle;
use App\Models\MoreDetail;
use App\Models\User;
use App\Observers\MoreDetailObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(UserObserver::class);
    }
}
