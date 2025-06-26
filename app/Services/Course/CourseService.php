<?php

namespace App\Services\Course;

use App\Http\Resources\Course\CourseResource;
use App\Http\Resources\Course\CourseWithDetailsResource;
use App\Models\Category;
use App\Models\Course;
use App\Models\Language;
use App\Models\Topic;

class CourseService
{
    // Get all courses in the platform, with a maximum of 5 courses per page.
    public function index(): array
    {
        $courses = Course::query()
            ->where('published', 'true')
            ->withCount('students')
            ->orderBy('rate', 'desc')
            ->orderBy('students_count', 'desc')
            ->paginate(5);

        return [
            'data' => CourseResource::collection($courses),
            'meta' => [
                'current_page' => $courses->currentPage(),
                'has_more_pages' => $courses->hasMorePages(),
                'next_page' => $courses->hasMorePages() ? $courses->currentPage() + 1 : null,
            ],
            'message' => 'Courses retrieved successfully',
            'code' => 200
        ];
    }

    // Load more courses, they are not appearing on the last page.
    public function loadMore($request): array
    {
        $courses = Course::query()
            ->where('published', 'true')
            ->withCount('students')
            ->orderBy('rate', 'desc')
            ->orderBy('students_count', 'desc')
            ->paginate(5, '*', 'page', $request['page']);
        return [
            'data' => CourseResource::collection($courses),
            'meta' => [
                'current_page' => $courses->currentPage(),
                'has_more_pages' => $courses->hasMorePages(),
                'next_page' => $courses->hasMorePages() ? $courses->currentPage() + 1 : null,
            ],
            'message' => 'Courses retrieved successfully',
            'code' => 200
        ];
    }

    public function store($request): array
    {

    }

    public function getCoursesForCategory($category_id): array
    {
        $category = Category::query()->find($category_id);
        if (!$category) {
            return ['message' => 'Category not found!', 'code' => 404];
        }
        $courses = Course::query()->whereHas('topic', function ($query) use ($category_id) {
            $query->where('category_id', $category_id);
        })
            ->where('published', 'true')
            ->withCount('students')
            ->orderBy('rate', 'desc')
            ->orderBy('students_count', 'desc')
            ->get()
            ->map(function ($course) {
                return new CourseResource($course);
            });
        return ['data' => $courses, 'message' => 'Courses retrieved successfully', 'code' => 200];
    }

    public function getCoursesForTopic($topic_id): array
    {
        if (!Topic::query()->find($topic_id)) {
            return ['message' => 'Topic not found!', 'code' => 404];
        }
        $courses = Course::query()
            ->where([
                'published' => 'true',
                'topic_id' => $topic_id
            ])
            ->withCount('students')
            ->orderBy('rate', 'desc')
            ->orderBy('students_count', 'desc')
            ->get();
        return ['data' => CourseResource::collection($courses), 'message' => 'Courses retrieved successfully', 'code' => 200];
    }

    public function getCoursesForLanguage($language_id): array
    {
        if (!Language::query()->find($language_id)) {
            return ['message' => 'Language not found!', 'code' => 404];
        }
        $courses = Course::query()
            ->where([
                'published' => 'true',
                'language_id' => $language_id
            ])
            ->withCount('students')
            ->orderBy('rate', 'desc')
            ->orderBy('students_count', 'desc')
            ->get();
        return ['data' => CourseResource::collection($courses), 'message' => 'Courses retrieved successfully', 'code' => 200];
    }

    public function search($title): array
    {
        $courses = Course::query()
            ->where('published', 'true')
            ->where('title', 'LIKE', "%$title%")
            ->withCount('students')
            ->orderBy('rate', 'desc')
            ->orderBy('students_count', 'desc')
            ->get();
        if ($courses->isEmpty()) {
            return [
                'data' => [],
                'message' => "No courses found for '{$title}'.",
                'suggestions' => Course::popular(Course::query())->pluck('title'),
                'code' => 200
            ];
        }
        return ['data' => CourseResource::collection($courses), 'message' => 'Courses retrieved successfully', 'code' => 200];
    }

    public function freeCourses(): array
    {
        $courses = Course::query()
            ->where([
                'published' => 'true',
                'price' => 0
            ])
            ->withCount('students')
            ->orderBy('rate', 'desc')
            ->orderBy('students_count', 'desc')
            ->paginate(5);

        return [
            'data' => CourseResource::collection($courses),
            'meta' => [
                'current_page' => $courses->currentPage(),
                'has_more_pages' => $courses->hasMorePages(),
                'next_page' => $courses->hasMorePages() ? $courses->currentPage() + 1 : null,
            ],
            'message' => 'Free Courses retrieved successfully',
            'code' => 200
        ];
    }

    public function paidCourses(): array
    {
        $courses = Course::query()
            ->where('published', 'true')
            ->where('price', '>', 0)
            ->withCount('students')
            ->orderBy('rate', 'desc')
            ->orderBy('students_count', 'desc')
            ->paginate(5);

        return [
            'data' => CourseResource::collection($courses),
            'meta' => [
                'current_page' => $courses->currentPage(),
                'has_more_pages' => $courses->hasMorePages(),
                'next_page' => $courses->hasMorePages() ? $courses->currentPage() + 1 : null,
            ],
            'message' => 'Paid Courses retrieved successfully',
            'code' => 200
        ];

    }

    public function show($id): array
    {
        $course = Course::query()
            ->where('published', 'true')
            ->find($id);
        if(is_null($course)) {
            return ['message' => 'Course not found!', 'code' => 404];
        }

        return ['data' => new CourseWithDetailsResource($course), 'message' => 'Course retrieved successfully', 'code' => 200];

    }

}
