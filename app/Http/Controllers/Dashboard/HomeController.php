<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Course;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $courses = Course::where('published', 'true')->get();
        $num_of_courses = count($courses);
        $num_of_students = User::whereIn('role', [RoleEnum::STUDENT, RoleEnum::TEACHER])->count();
        $num_of_teachers = User::where('role', RoleEnum::TEACHER)->count();
        $num_of_countries = Country::has('moreDetails')->count();
        $num_of_topics = Topic::has('courses')->count();
        $num_of_views = 0;
        foreach ($courses as $course)
            $num_of_views += $course->views;

        $data = [
            'num_of_courses' => $num_of_courses,
            'num_of_students' => $num_of_students,
            'num_of_teachers' => $num_of_teachers,
            'num_of_countries' => $num_of_countries,
            'num_of_topics' => $num_of_topics,
            'num_of_views' => $num_of_views
        ];

        return view('home', $data);
    }
}
