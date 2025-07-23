<?php

namespace App\Http\Controllers\App;

use App\Models\Category;
use App\Responses\Response;
use App\Services\Category\CategoryService;
use Illuminate\Http\JsonResponse;
use Throwable;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    // Get all categories.
    public function index(): JsonResponse
    {
        $data = [];
        try {
            $data = $this->categoryService->index();
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($message);
        }
    }

    public function search($title): JsonResponse
    {
        $data = [];
        try {
            $data = $this->categoryService->search($title);
            if(array_key_exists('suggestions', $data)) {
                return Response::successForSuggestions($data['data'], $data['message'], $data['suggestions'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message  = $th->getMessage();
            return Response::error($message);
        }
    }
}

