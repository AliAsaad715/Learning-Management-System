<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\App\Controller;
use App\Traits\manipulateImagesTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminProfileController extends Controller
{
    use manipulateImagesTrait;

    public function show()
    {
        return view('profile.show');
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'current_password' => ['nullable', 'required_with:new_password', 'current_password'],
            'new_password' => ['nullable', Rules\Password::defaults(), 'confirmed'],
        ]);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;

        if ($request->hasFile('profile_image'))
            $user->profile_image_url = $this->update_image($request->profile_image, 'profiles', $user->profile_image_url);


        if ($request->new_password) {
            $user->password = Hash::make($request->new_password);
        }

        $user->save();

        return to_route('profile.show')->with('success', 'Profile updated successfully!');
    }

    public function destroy_profile_image()
    {
        $user = auth()->user();
        $this->delete_image($user->profile_image_url, 'profiles');
        $user->profile_image_url = null;
        $user->save();

        return view('profile.show');
    }


    public function destroy_account(Request $request)
    {
        $user = auth()->user();
        $user->delete();
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('dashboard.login');
    }
}
