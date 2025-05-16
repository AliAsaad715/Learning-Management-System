<?php

namespace App\Providers;

use App\Mail\WelcomeUser;
use App\Models\JobTitle;
use App\Models\MoreDetail;
use App\Models\User;
use App\Observers\MoreDetailObserver;
use App\Observers\UserObserver;
use App\Models\Person;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

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
        Passport::loadKeysFrom(__DIR__.'/../secrets/oauth');
        Person::created(function ($user) {
            Mail::to($user)->send(new WelcomeUser($user));
        });
    }
}
