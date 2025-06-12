<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\App\Controller;
use App\Models\Category;
use App\Models\Course;
use App\Models\Episode;
use App\Models\Quiz;
use App\Models\Topic;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class CourseController extends Controller
{
    public function cates_and_topics()
    {
            $categories = Category::with('topics')->get();

            $pending_episodes = Episode::where('published', false)->with(['course' => function($q) {
                $q->with(['teacher' => function($q) {
                    $q->withTrashed();
                }]);
            }])->get();

        return view('courses.cates_and_topics', compact(['categories', 'pending_episodes']));
    }

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

    public function quiz($episode_id)
    {
        // Get the episode (even if trashed)
        $episode = Episode::withTrashed()->find($episode_id);

        // Now get its quiz
        $quiz = Quiz::where('episode_id', $episode->id)
            ->with(['questions' => function($q) {
                $q->orderBy('question_number');
            }])
            ->first();

        return view('courses.quiz', compact(['episode', 'quiz']));
    }

    public function rejected_episodes(Category $cate, Topic $topic)
    {
        $rejected_episodes = Episode::onlyTrashed()->with(['course' => function($q) {
            $q->with(['teacher' => function($q) {
                $q->withTrashed();
            }]);
        }])->get();

        return view('courses.rejected_courses', compact(['cate', 'topic', 'rejected_episodes']));
    }

    public function approve(Episode $episode)
    {
        $episode->published = true;
        $episode->admin_id = auth()->user()->id;
        $episode->publishing_date = now()->format('Y-m-d H:i:s');
        $episode->save();

        return back();
    }

    public function reject(Episode $episode)
    {
        $episode->admin_id = auth()->user()->id;
        $episode->delete();

        return back();
    }

    public function republish($episode_id)
    {
        $episode = Episode::onlyTrashed()->find($episode_id);
        $episode->restore();
        $episode->published = true;
        $episode->publishing_date = now()->format('Y-m-d H:i:s');
        $episode->save();

        return back();
    }
}
