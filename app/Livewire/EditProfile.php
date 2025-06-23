<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProfile extends Component
{
    use WithFileUploads;

    public $profile_image;
    public $first_name, $last_name, $email, $current_password, $new_password, $new_password_confirmation;

    public function update() 
    {
        $user = Auth::user();

        $validated = $this->validate([
            'first_name' => ['nullable', 'string', 'max:50'],
            'last_name' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'current_password' => ['nullable', 'required_with:new_password', 'current_password'],
            'new_password' => ['nullable', 'required_with:email', Password::defaults(), 'confirmed'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if($validated['profile_image'])
        {
            if($user->profile_image_url)
                $path = $this->profile_image->storeAs('img/profiles', $user->profile_image_url);
            else
                $path = $this->profile_image->store('img/profiles');
                
            $new_image_url = basename($path);
        }

        // Create the badge
        $user->update([
            'first_name' => $validated['first_name']?? $user->first_name,
            'last_name' => $validated['last_name']?? $user->last_name,
            'email' => $validated['email']?? $user->email,
            'password' => Hash::make($validated['new_password'])?? Hash::make($user->password),
            'profile_image_url' => $new_image_url?? $user->profile_image_url
        ]);

        return redirect()->route('profile.show');
    }

    public function destroy_profile_image()
    {
        $user = auth()->user();
        Storage::delete("img/profiles/$user->profile_image_url");
        $user->profile_image_url = null;
        $user->save();

        return redirect()->route('profile.show');
    }

    public function render()
    {
        return view('livewire.edit-profile')->layout('components.layouts.header', ['title' => 'Edit Profile']);
    }
}
