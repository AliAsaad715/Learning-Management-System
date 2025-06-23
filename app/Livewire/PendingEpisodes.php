<?php

namespace App\Livewire;

use App\Models\Episode;
use Livewire\Component;

class PendingEpisodes extends Component
{
    public $pendingEpisodes;

    public function approve(Episode $episode)
    {
        $episode->published = true;
        $episode->admin_id = auth()->user()->id;
        $episode->publishing_date = now()->format('Y-m-d H:i:s');
        $episode->save();
    }
    
    public function reject(Episode $episode)
    {
        $episode->admin_id = auth()->user()->id;
        $episode->delete();
    }

    public function render()
    {
        $this->pendingEpisodes = Episode::where('published', false)->with(['course' => function($q) {
            $q->with(['teacher' => function($q) {
                $q->withTrashed();
            }]);
        }])->get();
        
        return view('livewire.pending-episodes');
    }
}
