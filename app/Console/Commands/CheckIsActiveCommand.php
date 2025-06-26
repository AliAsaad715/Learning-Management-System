<?php

namespace App\Console\Commands;

use App\Enums\RoleEnum;
use App\Models\User;
use App\Services\FcmService;
use Illuminate\Console\Command;

class CheckIsActiveCommand extends Command
{
    protected $signature = 'active:check';

    protected $description = 'check if user is active daily';

    public function __construct(public FcmService $fcmService)    // Injection the fcm sevice
    {
        parent::__construct();
    }

    public function handle()
    {

        foreach(User::all() as $user)
        {
            if($user->role === RoleEnum::ADMIN)
                continue;
            $current_enthusiasm = $user->statistics()->where('title', 'Current Enthusiasm')->first();
            $max_enthusiasm = $user->statistics()->where('title', 'Max Enthusiasm')->first();
            
            if($user->moreDetail->is_active_today)
            {
                $current_enthusiasm->pivot->increment('progress');
                $user->moreDetail->num_of_inactive_days = 0;
                $user->moreDetail->save();

                if($current_enthusiasm->pivot->progress > $max_enthusiasm->pivot->progress)
                    $max_enthusiasm->pivot->update(['progress' => $current_enthusiasm->pivot->progress]);
                    
            }
            else
            {
                $current_enthusiasm->pivot->update(['progress' => 0]);
                $user->moreDetail->num_of_inactive_days += 1;
                $user->moreDetail->save();

                if($user->moreDetail->num_of_inactive_days == 3)
                {
                    $this->fcmService->sendNotification(
                        $user->fcm_token, 
                        'Your steps call you!',
                        "Three days of absence… every step awaits you. Return to us—you won't climb the 'Darajat' alone!"
                    );
                }
            }

            $user->moreDetail->is_active_today = false;
            $user->moreDetail->save();
        }
    }   
}
