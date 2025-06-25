<?php

namespace App\Http\Controllers\App;

use App\Models\Episode;
use App\Models\MoreDetail;
use App\Models\User;

class EpisodeController extends Controller
{
    // public function index($course_id)
    // {
    //     $episodes = Episode::where('course_id', $course_id)->get();

    //     return response()->json([
    //         'episodes' => $episodes
    //     ]);
    // }

    public function likeEpisode(Episode $episode)
    {
        if(auth()->user()->likeEpisode == null)
        {
            $episode->likes++;
            $episode->save();
        }

        return back();
    }

    public function finish_an_episode(Episode $episode)
    {
        $e
        auth()->user()->more_details->is_active_today = true;
        auth()->user()->more_details->save();
        
        return response()->json([
            'message' => 'user today is active'
        ], 200);
    }
}
