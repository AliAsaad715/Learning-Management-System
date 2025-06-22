<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\App\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Episode;
use App\Models\Quiz;
use App\Models\Topic;

class CourseController extends Controller
{
    public function active_courses(Category $cate, Topic $topic)
    {
        $courses = Course::where(['topic_id' => $topic->id, 'published' => 'true'])->with(['teacher' => function($q) {
            $q->withTrashed();
        }])->get();

        return view('courses.active_courses',['cate' => $cate->title, 'topic' => $topic->title, 'courses' => $courses]);
    }

    public function show_course(Course $course)
    {
        $course->load(['episodes', 'teacher' => function($q) {
            $q->withTrashed();
        }])->get();


        $course->loadCount(['episodes' => function($query) {
            $query->whereHas('quiz');
        }]);

        return view('courses.show_course', compact('course'));
    }

    public function video($episode_id)
    {
        $episode = Episode::withTrashed()->with(['comments' => function($q) {
        $q->with(['replies' => function($q) {
            $q->with(['user' => function($q) {
                $q->withTrashed(); // Only users with trashed
            }]);
        }, 'user' => function($q) {
            $q->withTrashed(); // Only users with trashed
        }]);
    }])->find($episode_id);

        return view('courses.video', compact('episode'));
    }

    public function quiz(Episode $episode)
    {

        // Now get its quiz
        $quiz = Quiz::where('episode_id', $episode->id)
            ->with(['questions' => function($q) {
                $q->orderBy('question_number');
            }])
            ->first();

        return view('courses.quiz', compact(['episode', 'quiz']));
    }

    public function rejected_episodes()
    {
        
        return view('courses.rejected_courses', compact(['cate', 'topic', 'rejected_episodes']));
    }

}
