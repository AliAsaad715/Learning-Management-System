<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Ban extends Component
{
    public $user;

    public function ban()
    {
        $this->user->delete();
        $this->user->moreDetail()->update(['is_banned' => true]);
    }

    public function unban()
    {
        $this->user->restore();
        $this->user->moreDetail()->update(['is_banned' => false]);
    }

    public function render()
    {
        return view('livewire.ban');
    }
}
