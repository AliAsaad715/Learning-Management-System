<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\App\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminProfileController extends Controller
{
    public function show()
    {
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
