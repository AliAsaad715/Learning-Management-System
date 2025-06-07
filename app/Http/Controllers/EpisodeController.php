<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;

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
}
