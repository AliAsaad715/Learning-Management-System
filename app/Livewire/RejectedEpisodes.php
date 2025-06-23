<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Episode;
use App\Models\Topic;
use Livewire\Component;

class RejectedEpisodes extends Component
{
    public $cate, $topic;

    public function mount(Category $cate, Topic $topic)
    {
        $this->cate = $cate;
        $this->topic = $topic;
    }

    public function republish($episode_id)
    {
        $episode = Episode::onlyTrashed()->where('id', $episode_id)->first();
        $episode->restore();
        $episode->published = true;
        $episode->publishing_date = now()->format('Y-m-d H:i:s');
        $episode->save();
    }

    public function render()
    {
        $rejected_episodes = Episode::onlyTrashed()->with(['course' => function($q) {
            $q->with(['teacher' => function($q) {
                $q->withTrashed();
            }]);
        }])->get();

        $cate = $this->cate;
        $topic = $this->topic;

        return view('livewire.rejected-episodes', compact(['cate', 'topic', 'rejected_episodes']))->layout('components.layouts.header', ['title' => 'Course Management', 'withFooter' => 'true']);
    }
}
