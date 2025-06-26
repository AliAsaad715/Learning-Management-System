<?php

namespace App\Services\Category;

use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;

class CategoryService
{
    public function index(): array
    {
        $categories = Category::query()->orderBy('title')->get();
        return ['data' => CategoryResource::collection($categories), 'message' => 'Categories retrieved successfully', 'code' => 200];
    }

    public function search($title): array
    {
        $categories = Category::query()
            ->where('title', 'LIKE' ,"%$title%")
            ->orderBy('title', 'asc')
            ->get();
        if($categories->isEmpty()) {
            return [
                'data' => [],
                'message' => "No categories found for '{$title}'.",
                'suggestions' => Category::popular(Category::query())->pluck('title'),
                'code' => 200
            ];
        }
        return ['data' => CategoryResource::collection($categories), 'message' => 'Categories retrieved successfully', 'code' => 200];
    }
}
