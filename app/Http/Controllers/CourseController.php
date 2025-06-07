<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Topic;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function cates_and_topics()
    {
            $categories = Category::with('topics')->get();


        return response()->json([
            'categories' => $categories
        ]);
    }

    public function index(Topic $topic)
    {
        $courses = Course::where(['topic_id' => $topic->id, 'published' => 'true'])->get();

        return response()->json([
            'courses' => $courses
        ]);
    }

    public function search(Request $request) 
    {
        $courses = Course::where('title','like', "%{$request->name}%")->get();

        return response()->json([
            'courses' => $courses
        ]);
    }
}
