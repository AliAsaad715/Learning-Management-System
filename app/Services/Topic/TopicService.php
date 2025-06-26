<?php

namespace App\Services\Topic;

use App\Models\Category;
use App\Models\Topic;

class TopicService
{
    // Get all topics for specific category.
    public function index($category_id): array
    {
        if (!Category::query()->find($category_id)) {
            return ['message' => 'Category not found!', 'code' => 404];
        }
        $topics = Topic::query()
            ->select('id', 'title')
            ->where('category_id', $category_id)
            ->orderBy('title')
            ->get();
        return ['data' => $topics, 'message' =>'Topics retrieved successfully', 'code' => 200];
    }

    public function search($title): array
    {
        $topics = Topic::query()
            ->select('id', 'title')
            ->where('title', 'LIKE' ,"%$title%")
            ->orderBy('title')
            ->get();
        if($topics->isEmpty()) {
            return [
                'data' => [],
                'message' => "No topics found for '{$title}'.",
                'suggestions' => Topic::popular(Topic::query())->pluck('title'),
                'code' => 200
            ];
        }
        return ['data' => $topics, 'message' => 'Topics retrieved successfully', 'code' => 200];
    }
}
