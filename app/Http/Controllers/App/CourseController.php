<?php

namespace App\Http\Controllers\App;

use App\Models\Topic;
use App\Models\Course;
use App\Models\LanguageUser;
use App\Responses\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{

    public function indexCourse($topicId){
        if (!Topic::find($topicId))
            return Response::error([], 'topic not found', 404);

         $courses = Course::where('topic_id',$topicId)->get();

        if($courses->isEmpty())
            return Response::error([], 'no courses in this topic', 404);

        return Response::success($courses, 'get courses successfully');
    }

    public function searchCourse($courseTitle){
        $courses= Course::where('title','LIKE',"%$courseTitle%")->get();
        if($courses->isEmpty())
            return Response::error([], 'no course have this title', 404);

        return Response::success($courses, 'get searsh courses successfully');

    }

    public function freeCourse(){
         $courses = Course::where('price', 0.0)->get();
        if($courses->isEmpty())
            return Response::error([], 'no course is free', 404);

        return Response::success($courses, 'get free course successfully');

    }

    public function paidCourse(){
        $courses = Course::where('price','>', 0.0)->get();
        if($courses->isEmpty())
            return Response::error([], 'no course is paid', 404);

        return Response::success($courses, 'get paid course successfully');

    }

    public function showAllCourses(){
        $courses = Course::get();
        if($courses->isEmpty())
            return Response::error([], 'no courses', 404);

        return Response::success($courses, 'get all courses successfully');
    }


}

