<?php

namespace App\Livewire;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class RegisterForm extends Component
{
    public $first_name, $last_name, $email, $password, $password_confirmation, $admin_secret;

    public function register()
    {
        $this->validate([
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
            'admin_secret' => ['required', 'string', 'in:'.config('auth.admin_secret')],
        ]);

        $user = User::create([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => RoleEnum::ADMIN,
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.register-form')->layout('components.layouts.auth-background', ['title' => 'Register']);
    }
}
