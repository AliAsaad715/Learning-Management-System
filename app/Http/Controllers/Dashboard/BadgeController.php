<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\App\Controller;
use App\Models\Badge;
use App\Traits\manipulateImagesTrait;
use Illuminate\Http\Request;

class BadgeController extends Controller
{
    use manipulateImagesTrait;

    public function index()
    {
        $bronzeBadges = Badge::where('level', 1)->get();
        $silverBadges = Badge::where('level', 2)->get();
        $goldBadges = Badge::where('level', 3)->get();

        return view('badges.index', compact('bronzeBadges', 'silverBadges', 'goldBadges'));
    }

    public function create(Request $request)
    {
        // Pre-select level if coming from level-specific button
        $preselected_level = $request->has('level') ? $request->level : null;

        return view('badges.create', compact('preselected_level'));
    }

    public function store(Request $request)
    {

        // Validate the request data
        $validated = $request->validate([
            'group' => 'required|string|max:50',
            'level' => 'required|integer|between:1,5',
            'description' => 'required|string|unique:badges,description',
            'goal' => 'required|integer|min:1|max:32767',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'created_by' => 'required'
        ]);

        try {
            // Handle image upload
            $image_name= $this->store_image($validated['image_url'], 'badges');

            // Create the badge
            Badge::create([
                'group' => $validated['group'],
                'level' => $validated['level'],
                'description' => $validated['description'],
                'goal' => $validated['goal'],
                'image_url' => $image_name,
                'admin_id' => $validated['created_by']
            ]);

            return to_route('badges.index')
                ->with('success', 'Badge created successfully!');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error creating badge: ' . $e->getMessage());
        }
    }

    public function show(Badge $badge)
    {
        $admin_name = $badge->admin->first_name .' ' . $badge->admin->last_name;
        return view('badges.show', compact(['badge', 'admin_name']));
    }

    public function edit(Badge $badge)
    {
        return view('badges.edit', compact('badge'));
    }

    public function update(Request $request, Badge $badge)
    {
        $validated = $request->validate([
            'group' => 'required|string|max:50',
            'level' => 'required|integer|between:1,5',
            'description' => 'required|string|unique:badges,description,'.$badge->id,
            'goal' => 'required|integer|min:1|max:32767',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            // Handle image upload if new image provided
            if(isset($validated['image_url']))
            {
                $image_name= $this->update_image($validated['image_url'], 'badges', $badge->image_url);

                // Create the badge
                $badge = $badge->update([
                    'image_url' => $image_name
                ]);
            }

            return to_route('badges.show', $badge->id)
                ->with('success', 'Badge updated successfully!');

        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Error updating badge: ' . $e->getMessage());
        }
    }

    public function destroy(Badge $badge)
    {
        try {
            // Delete associated image
            $this->delete_image($badge->image_url, 'badges');

            $badge->delete();

            return to_route('badges.index')
                ->with('success', 'Badge deleted successfully!');

        } catch (\Exception $e) {
            return back()
                ->with('error', 'Error deleting badge: ' . $e->getMessage());
        }
    }
}
