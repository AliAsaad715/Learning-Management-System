<?php

namespace App\Providers;

use App\Enums\TypeEnum;
use App\Models\User;
use App\Observers\UserObserver;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

        RateLimiter::for('resend-otp', function (Request $request) {
            if ($request->has('email')) {
                return Limit::perMinute(1)->by($request->input('email'));
            }
            return Limit::perMinute(2)->by($request->ip());
        });

    }
}
//composer require laravel/passport  php artisan passport:install


