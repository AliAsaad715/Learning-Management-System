<?php

namespace App\Observers;

use App\Mail\ChangePassword;
use App\Mail\WelcomeUser;
use App\Models\Statistic;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        foreach(Statistic::all() as $statistic)
            $user->statistics()->attach($statistic, ['progress' => 0]);
        Mail::to($user)->send(new WelcomeUser($user));
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        if ($user->isDirty('password')) {
            Mail::to($user)->send(new ChangePassword($user));
        }
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
