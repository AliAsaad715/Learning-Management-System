<?php

namespace App\Http\Controllers\dashboard;

use App\Enums\RoleEnum;
use App\Enums\TypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(Request $request, TypeEnum $type)
    {
        $filter = $request->input('filter', 'all');

        $query = User::withTrashed()->with([
            'moreDetail.jobTitle',
            'moreDetail.country',
            'moreDetail.languages',
            'moreDetail.skills'
        ])->whereHas('moreDetail');


        // Apply role filter ONLY if $type = 'teacher'
        if ($type === TypeEnum::TEACHER) {
            $query->where('role', 'teacher');
        }

        // Apply status filter (active/banned/deleted)
        switch ($filter) {
            case 'active':
                $query->where('deleted_at', null)
                    ->whereHas('moreDetail', fn($q) => $q->where('is_banned', false));
                break;
            case 'banned':
                $query->where('deleted_at', '!=', null)
                    ->whereHas('moreDetail', fn($q) => $q->where('is_banned', true));
                break;
            case 'deleted':
                $query->where('deleted_at', '!=', null)
                    ->whereHas('moreDetail', fn($q) => $q->where('is_banned', false));
                break;
            default: // 'all' (no additional filters)
                $query->withTrashed();
        }

        // Get counts (respecting $type)
        $countQuery = User::withTrashed()->whereHas('moreDetail');

        if ($type === TypeEnum::TEACHER) {
            $countQuery->where('role', 'teacher');
        }

        $counts = [
            'all'     => $countQuery->count(),
            'active'  => $countQuery->clone()
                ->where('deleted_at', null)
                ->whereHas('moreDetail', fn($q) => $q->where('is_banned', false))
                ->count(),
            'banned'  => $countQuery->clone()
                ->where('deleted_at', '!=', null)
                ->whereHas('moreDetail', fn($q) => $q->where('is_banned', true))
                ->count(),
            'deleted' => $countQuery->clone()
                ->where('deleted_at', '!=', null)
                ->whereHas('moreDetail', fn($q) => $q->where('is_banned', false))
                ->count(),
        ];

        $users = $query->orderBy('created_at', 'desc')->get();

        return view('users.index', array_merge(compact('users', 'counts', 'filter'), ['type' => $type]));
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

    public function ban_user(User $user)
    {
        $user->delete();
        $user->moreDetail()->update(['is_banned' => true]);

        return back();
    }

    public function unban_user(User $user)
    {
        $user->restore();
        $user->moreDetail()->update(['is_banned' => false]);

        return back();
    }

}
