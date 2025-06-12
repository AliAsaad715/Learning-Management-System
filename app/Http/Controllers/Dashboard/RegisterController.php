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

class RegisterController extends Controller
{
    use manipulateImagesTrait;

    public function showRegistrationForm()
    {
        return view('auth.register');
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            // 'profile_image_url' => ['image', 'max: 5120', 'nullable'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)],
            'admin_secret' => ['required', 'string', 'in:'.config('auth.admin_secret')],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // if(isset($request->profile_image_url))
        //     $profile_image_url = $this->storeImage($request->profile_image_url, 'img/people');

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            // 'profile_image_url' => $profile_image_url?? null,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => RoleEnum::ADMIN,
        ]);

        Auth::login($user);

        return to_route('home');
    }
}
