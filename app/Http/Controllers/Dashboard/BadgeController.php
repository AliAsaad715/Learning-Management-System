<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\App\Controller;
use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BadgeController extends Controller
{

    public function index()
    {
        $bronzeBadges = Badge::where('level', 1)->get();
        $silverBadges = Badge::where('level', 2)->get();
        $goldBadges = Badge::where('level', 3)->get();

        return view('badges.index', compact('bronzeBadges', 'silverBadges', 'goldBadges'));
    }

    public function show(Badge $badge)
    {
        $admin_name = $badge->admin->first_name .' ' . $badge->admin->last_name;
        return view('badges.show', compact(['badge', 'admin_name']));
    }

    public function destroy(Badge $badge)
    {
        try {
            // Delete associated image
            Storage::delete("img/badges/$badge->image_url");

            $badge->delete();

            return to_route('badges.index')
                ->with('success', 'Badge deleted successfully!');

        } catch (\Exception $e) {
            return back()
                ->with('error', 'Error deleting badge: ' . $e->getMessage());
        }
    }
}
