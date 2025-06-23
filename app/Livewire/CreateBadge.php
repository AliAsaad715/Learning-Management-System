<?php

namespace App\Livewire;

use App\Models\Badge;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateBadge extends Component
{
    use WithFileUploads;
    
    public $group, $level, $description, $goal, $image_url, $created_by;

    public function mount()
    {
        // Pre-select level if coming from level-specific button
        $this->level = request()->has('level') ? request('level'): null;
        $this->created_by = auth()->user()->id;
    }

    public function create()
    {
        // Validate the request data
        $validated = $this->validate([
            'group' => 'required|string|max:50',
            'level' => 'required|integer|between:1,5',
            'description' => 'required|string|unique:badges,description',
            'goal' => 'required|integer|min:1|max:32767',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'created_by' => 'required'
        ]);

        $path = $this->image_url->store('img/badges');
        $image_name = basename($path);

        // Create the badge
        Badge::create([
            'group' => $validated['group'],
            'level' => $validated['level'],
            'description' => $validated['description'],
            'goal' => $validated['goal'],
            'image_url' => $image_name,
            'admin_id' => $validated['created_by']
        ]);

        return redirect()->route('badges.index');
    }

    public function render()
    {
        return view('livewire.create-badge')->layout('components.layouts.header', ['title' => 'Create New Badge', 'withFooter' => true]);
    }
}
