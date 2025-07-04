<?php

namespace App\Http\Controllers\App;

use App\Http\Requests\Course\CourseRequest;
use App\Http\Requests\Course\EvaluationCourseRequest;
use App\Http\Requests\Course\LoadMoreCoursesRequest;
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

    // Load 5 courses for specific page, they are not appearing on the last page.
    public function loadMore(LoadMoreCoursesRequest $request): JsonResponse
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

    public function store(CourseRequest $request): JsonResponse
    {
        $data = [];
        try {
            $data = $this->courseService->store($request->validated());
            return Response::success($data['data'], $data['message'], $data['code']);
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

    public function getFreeCourses(): JsonResponse
    {
        $data = [];
        try {
            $data = $this->courseService->getFreeCourses();
            return Response::successForPaginate($data['data'], $data['meta'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    public function getPaidCourses(): JsonResponse
    {
        $data = [];
        try {
            $data = $this->courseService->getPaidCourses();
            return Response::successForPaginate($data['data'], $data['meta'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    public function getDraftCoursesToTeacher(): JsonResponse
    {
        $data = [];
        try {
            $data = $this->courseService->getDraftCoursesToTeacher();
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    public function getPendingCoursesToTeacher(): JsonResponse
    {
        $data = [];
        try {
            $data = $this->courseService->getPendingCoursesToTeacher();
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    public function getApprovedCoursesToTeacher(): JsonResponse
    {
        $data = [];
        try {
            $data = $this->courseService->getApprovedCoursesToTeacher();
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    public function getRejectedCoursesToTeacher(): JsonResponse
    {
        $data = [];
        try {
            $data = $this->courseService->getRejectedCoursesToTeacher();
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    public function showToTeacher($id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->courseService->showToTeacher($id);
            if($data['code'] == 404) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    public function showToStudent($id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->courseService->showToStudent($id);
            if($data['code'] == 404) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    public function publishCourse($id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->courseService->publishCourse($id);
            if($data['code'] == 404 || $data['code'] == 422) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success([], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }

    public function evaluation(EvaluationCourseRequest $request , $id): JsonResponse
    {
        $data = [];
        try {
            $data = $this->courseService->evaluation($request->validated(), $id);
            if($data['code'] == 422) {
                return Response::error([], $data['message'], $data['code']);
            }
            return Response::success($data['data'], $data['message'], $data['code']);
        } catch (Throwable $th) {
            $message = $th->getMessage();
            return Response::error($data, $message);
        }
    }
}

