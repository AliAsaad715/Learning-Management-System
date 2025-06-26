<?php

namespace App\Http\Controllers\App;

use App\Models\Topic;
use App\Responses\Response;
use App\Services\Topic\TopicService;
use Illuminate\Http\JsonResponse;
use Throwable;

class TopicController extends Controller
{
    private TopicService $topicService;

    public function __construct(TopicService $topicService) {
        $this->topicService = $topicService;
    }
    public function index($category_id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->topicService->index($category_id);
            if($data['code'] == 404) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($data, $message);
        }

    }

    public function search($title): JsonResponse
    {
        $data = [];
        try {
            $data = $this->topicService->search($title);
            if(array_key_exists('suggestions', $data)) {
                return Response::successForSuggestions($data['data'], $data['message'], $data['suggestions'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($data, $message);
        }
    }
}
