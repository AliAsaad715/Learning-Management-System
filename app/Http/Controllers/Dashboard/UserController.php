<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\RoleEnum;
use App\Enums\TypeEnum;
use App\Models\Course;
use App\Http\Controllers\App\Controller;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request, TypeEnum $type)
    {

        return view('users.index', ['type' => $type]);
    }

    public function show_user($user_id)
    {
        $user = User::withTrashed()->with([
            'moreDetail.jobTitle',
            'moreDetail.country',
            'moreDetail.skills',
            'moreDetail.languages' => function($query) {
            $query->withPivot('level');
            },
            'followed_courses',
            'badges',
            'statistics',
            'comments' => function($query) {
                $query->with('episode')->whereHas('episode');
            }
            ])->findOrFail($user_id);

        $counts = [
            'followed_courses_count' => $user->followed_courses ? $user->followed_courses->count() : 0,
            'activities_count' => $user->comments ? $user->comments->count() : 0,
            'badges_count' => $user->badges ? $user->badges->count() : 0
        ];

        $mother_tongue = $user->moreDetail->languages()->wherePivot('level', 'mother_tongue')->first();



        return view('users.show_user', compact(['user', 'counts', 'mother_tongue']));
    }

    public function followed_course($user_id, $course_id)
    {
        $user = User::withTrashed()->find($user_id);
        $course = $user->followed_courses()
            ->with(['teacher' => function($q) {
                $q->withTrashed();
            }]) // Eager load the relationship
            ->where('courses.id', $course_id)
            ->first();

        $quizzes = Quiz::select('quizzes.*', 'quiz_user.mark', 'quiz_user.quiz_submission_date', 'quiz_user.success')
            ->join('episodes', 'quizzes.episode_id', '=', 'episodes.id')
            ->join('quiz_user', 'quizzes.id', '=', 'quiz_user.quiz_id')
            ->where('episodes.course_id', $course_id)
            ->where('quiz_user.user_id', $user_id)
            ->with('episode:id,title,course_id')
            ->get();

        $total_quizzes = $course->episodes()->whereHas('quiz')->count();
        $rating = $course->pivot->rate ?? 0;

        return view('users.followed_course', compact(['course', 'quizzes', 'total_quizzes', 'rating']));
    }

    public function show_teacher($teacher_id)
    {
        $user = User::withTrashed()->with([
            'moreDetail.jobTitle',
            'moreDetail.country',
            'moreDetail.skills',
            'moreDetail.languages' => function($query) {
            $query->withPivot('level');
            },
            'published_courses' => function($q) {
                $q->with(['teacher' => function($q) {
                    $q->withTrashed();
                }]);
            }])->findOrFail($teacher_id);

        $acquired_views = $user->statistics->where('title', 'Acquired Views')->first();
        $acquired_likes = $user->statistics->where('title', 'Acquired Likes')->first();


        $counts = [
            'published_courses' => $user->published_courses ? $user->published_courses->count() : 0,
            'acquired_views' => $acquired_views ? $acquired_views->pivot->progress : 0,
            'acquired_likes' => $acquired_likes ? $acquired_likes->pivot->progress : 0
        ];

        $mother_tongue = $user->moreDetail->languages()->wherePivot('level', 'mother_tongue')->first();

        return view('users.show_teacher', compact(['user', 'counts', 'mother_tongue']));
    }

    


}
