<?php

namespace App\Http\Controllers\App;

use App\Models\Category;
use App\Models\Topic;
use App\Responses\Response;
use Illuminate\Http\Request;


class TopicController extends Controller
{
    public function indexTopics($categoryId){

        if (!Category::find($categoryId))
            return Response::error([], 'category not found', 404);

        $topics = Topic::where('category_id',$categoryId)->get();

        if($topics->isEmpty())
            return Response::error([], 'no topics in this caretgory', 404);

        return Response::success($topics, 'get topics successfully');

    }

    public function searchTopic($topicTitle){
        $topics= Topic::where('title','LIKE',"%$topicTitle%")->get();
        if($topics->isEmpty())
            return Response::error([], 'no topic have this title', 404);

        return Response::success($topics, 'get searsh topics successfully');

    }
}
