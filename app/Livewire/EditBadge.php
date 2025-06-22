<?php

namespace App\Livewire;

use App\Models\Badge;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditBadge extends Component
{
    use WithFileUploads;

    public $image_url;
    public $group, $level, $description, $goal, $badge;

    public function mount(Badge $badge)
    {
        $this->badge = $badge;
    }

    public function update()
    {
        $validated = $this->validate([
            'group' => 'nullable|string|max:50',
            'level' => 'nullable|integer|between:1,5',
            'description' => 'nullable|string|unique:badges,description,'.$this->badge->id,
            'goal' => 'nullable|integer|min:1|max:32767',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $badge = $this->badge;
        if($validated['image_url'])
        {
            $path = $this->image_url->storeAs('img/badges', $badge->image_url);
            $new_image_url = basename($path);
        }

        // Create the badge
        $this->badge->update([
            'group' => $validated['group']?? $badge->group,
            'level' => $validated['level']?? $badge->level,
            'description' => $validated['description']?? $badge->description,
            'goal' => $validated['goal']?? $badge->goal,
            'image_url' => $new_image_url?? $badge->image_url
        ]);

        return redirect()->route('badges.show', $badge->id);

    }

    public function render()
    {
        return view('livewire.edit-badge')->layout('components.layouts.header', ['title' => 'Edit Badge', 'withFooter' => true]);
    }
}
