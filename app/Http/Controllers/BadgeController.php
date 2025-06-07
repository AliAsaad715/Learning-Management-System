<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $bronzeBadges = $user->badges()->where('level', 1)->get();
        $silverBadges = $user->badges()->where('level', 2)->get();
        $goldBadges = $user->badges()->where('level', 3)->get();

        return response()->json([
            'bronze_badges' => $bronzeBadges,
            'silver_badges' => $silverBadges,
            'gold_badges' => $goldBadges,
        ]);
    }
}
