<?php

namespace App\Providers;

use App\Enums\TypeEnum;
use App\Models\Course;
use App\Models\User;
use App\Observers\UserObserver;
use App\Policies\CoursePolicy;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Console\Scheduling\Schedule;
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

    protected array $policies = [
        Course::class => CoursePolicy::class,

        'owner' => CoursePolicy::class,
        'createCoupon' => CoursePolicy::class,
    ];

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

        if (app()->environment('local')) {
        $this->app->booted(function () {
            $schedule = app(Schedule::class);
            $schedule->command('active:check')
                // ->dailyAt('03:00') // Runs at 3 AM daily
                ->everyMinute()
                ->timezone('Asia/Damascus');
            });
        }
    }
}
//composer require laravel/passport  php artisan passport:install


