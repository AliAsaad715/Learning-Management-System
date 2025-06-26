<?php

namespace App\Http\Controllers\App;

use App\Http\Requests\LoadMore\LoadMoreRequest;
use App\Responses\Response;
use App\Services\Course\CourseService;
use Illuminate\Http\JsonResponse;
use Throwable;

class CourseController extends Controller
{
    private CourseService $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function index(): JsonResponse
    {
        $data = [];
        try {
            $data = $this->courseService->index();
            return Response::successForPaginate($data['data'], $data['meta'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    // Load 15 comments for specific episode and specific page, they are not appearing on the last page.
    public function loadMore(LoadMoreRequest $request): JsonResponse
    {
        $data = [];
        try {
            $data = $this->courseService->loadMore($request->validated());
            if ($data['code'] == 404) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::successForPaginate($data['data'], $data['meta'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    public function getCoursesForCategory($category_id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->courseService->getCoursesForCategory($category_id);
            if ($data['code'] == 404) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    public function getCoursesForTopic($topic_id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->courseService->getCoursesForTopic($topic_id);
            if ($data['code'] == 404) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    public function getCoursesForLanguage($language_id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->courseService->getCoursesForLanguage($language_id);
            if ($data['code'] == 404) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    public function search($title): JsonResponse
    {
        $data = [];
        try {
            $data = $this->courseService->search($title);
            if (array_key_exists('suggestions', $data)) {
                return Response::successForSuggestions($data['data'], $data['message'], $data['suggestions'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    public function freeCourses(): JsonResponse
    {
        $data = [];
        try {
            $data = $this->courseService->freeCourses();
            return Response::successForPaginate($data['data'], $data['meta'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    public function paidCourses(): JsonResponse
    {
        $data = [];
        try {
            $data = $this->courseService->paidCourses();
            return Response::successForPaginate($data['data'], $data['meta'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    public function show($id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->courseService->show($id);
            if($data['code'] == 404) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }


}

