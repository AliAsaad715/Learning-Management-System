<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\RoleEnum;
use App\Http\Controllers\App\Controller;
use App\Models\User;
use App\Traits\manipulateImagesTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

class WebAuthController extends Controller
{
    use manipulateImagesTrait;


    // Register

    public function showRegistrationForm()
    {
        return view('auth.register');
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'admin_secret' => ['required', 'string', 'in:'.config('auth.admin_secret')],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => RoleEnum::ADMIN,
        ]);

        Auth::login($user);

        return to_route('home');
    }



    // Login
    
    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return to_route('home');
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('dashboard.login');
    }
}
