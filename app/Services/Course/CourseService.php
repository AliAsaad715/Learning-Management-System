<?php

namespace App\Services\Course;

use App\Enums\CourseStatusEnum;
use App\Http\Resources\Course\Student\CourseForStudentResource;
use App\Http\Resources\Course\Student\CourseWithDetailsForStudentResource;
use App\Http\Resources\Course\Teacher\CourseForTeacherResource;
use App\Http\Resources\Course\Teacher\CourseWithDetailsForTeacherResource;
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
            ->where('status', CourseStatusEnum::APPROVED)
            ->withCount('students')
            ->orderBy('rate', 'desc')
            ->orderBy('students_count', 'desc')
            ->paginate(5);

        return [
            'data' => CourseForStudentResource::collection($courses),
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
        if ($request['type'] == 'all') {
            $courses = Course::query()
                ->where('status', CourseStatusEnum::APPROVED)
                ->withCount('students')
                ->orderBy('rate', 'desc')
                ->orderBy('students_count', 'desc')
                ->paginate(5, '*', 'page', $request['page']);
        } else if ($request['type'] == 'free') {
            $courses = Course::query()
                ->where([
                    'status' => CourseStatusEnum::APPROVED,
                    'price' => '0'
                ])
                ->withCount('students')
                ->orderBy('rate', 'desc')
                ->orderBy('students_count', 'desc')
                ->paginate(5, '*', 'page', $request['page']);
        } else if ($request['type'] == 'paid') {
            $courses = Course::query()
                ->where('status', CourseStatusEnum::APPROVED)
                ->where('price', '>', 0)
                ->withCount('students')
                ->orderBy('rate', 'desc')
                ->orderBy('students_count', 'desc')
                ->paginate(5, '*', 'page', $request['page']);
        }

        return [
            'data' => CourseForStudentResource::collection($courses),
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
        $request['teacher_id'] = auth('api')->id();
        $path = $request['image_url']->store('img/courses', 'public');
        $request['image_url'] = basename($path);
        $course = Course::query()->create($request);
        $course->refresh();
        return ['data' => new CourseWithDetailsForTeacherResource($course), 'message' => 'Course created successfully', 'code' => 201];
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
            ->where('status', CourseStatusEnum::APPROVED)
            ->withCount('students')
            ->orderBy('rate', 'desc')
            ->orderBy('students_count', 'desc')
            ->get()
            ->map(function ($course) {
                return new CourseForStudentResource($course);
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
                'status' => CourseStatusEnum::APPROVED,
                'topic_id' => $topic_id
            ])
            ->withCount('students')
            ->orderBy('rate', 'desc')
            ->orderBy('students_count', 'desc')
            ->get();
        return ['data' => CourseForStudentResource::collection($courses), 'message' => 'Courses retrieved successfully', 'code' => 200];
    }

    public function getCoursesForLanguage($language_id): array
    {
        if (!Language::query()->find($language_id)) {
            return ['message' => 'Language not found!', 'code' => 404];
        }
        $courses = Course::query()
            ->where([
                'status' => CourseStatusEnum::APPROVED,
                'language_id' => $language_id
            ])
            ->withCount('students')
            ->orderBy('rate', 'desc')
            ->orderBy('students_count', 'desc')
            ->get();
        return ['data' => CourseForStudentResource::collection($courses), 'message' => 'Courses retrieved successfully', 'code' => 200];
    }

    public function search($title): array
    {
        $courses = Course::query()
            ->where('status', CourseStatusEnum::APPROVED)
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
        return ['data' => CourseForStudentResource::collection($courses), 'message' => 'Courses retrieved successfully', 'code' => 200];
    }

    public function getFreeCourses(): array
    {
        $courses = Course::query()
            ->where([
                'status' => CourseStatusEnum::APPROVED,
                'price' => 0
            ])
            ->withCount('students')
            ->orderBy('rate', 'desc')
            ->orderBy('students_count', 'desc')
            ->paginate(5);

        return [
            'data' => CourseForStudentResource::collection($courses),
            'meta' => [
                'current_page' => $courses->currentPage(),
                'has_more_pages' => $courses->hasMorePages(),
                'next_page' => $courses->hasMorePages() ? $courses->currentPage() + 1 : null,
            ],
            'message' => 'Free Courses retrieved successfully',
            'code' => 200
        ];
    }

    public function getPaidCourses(): array
    {
        $courses = Course::query()
            ->where('status', CourseStatusEnum::APPROVED)
            ->where('price', '>', 0)
            ->withCount('students')
            ->orderBy('rate', 'desc')
            ->orderBy('students_count', 'desc')
            ->paginate(5);

        return [
            'data' => CourseForStudentResource::collection($courses),
            'meta' => [
                'current_page' => $courses->currentPage(),
                'has_more_pages' => $courses->hasMorePages(),
                'next_page' => $courses->hasMorePages() ? $courses->currentPage() + 1 : null,
            ],
            'message' => 'Paid Courses retrieved successfully',
            'code' => 200
        ];

    }

    public function showToTeacher($id): array
    {
        $course = Course::query()
            ->where([
                'teacher_id' => auth('api')->id(),
                'id' => $id
            ])->first();

        if (is_null($course)) {
            return ['message' => 'Course not found!', 'code' => 404];
        }

        return ['data' => new CourseWithDetailsForTeacherResource($course), 'message' => 'Course retrieved successfully', 'code' => 200];
    }

    public function showToStudent($id): array
    {
        $course = Course::query()
            ->where('status', CourseStatusEnum::APPROVED)
            ->find($id);
        if (is_null($course)) {
            return ['message' => 'Course not found!', 'code' => 404];
        }

        return ['data' => new CourseWithDetailsForStudentResource($course), 'message' => 'Course retrieved successfully', 'code' => 200];
    }

    public function getDraftCoursesToTeacher(): array
    {
        $courses = Course::query()
            ->where([
                'teacher_id' => auth('api')->id(),
                'status' => CourseStatusEnum::DRAFT,
            ])
            ->latest('created_at')
            ->get();

        return ['data' => CourseForTeacherResource::collection($courses), 'message' => 'Course retrieved successfully', 'code' => 200];
    }

    public function getPendingCoursesToTeacher(): array
    {
        $courses = Course::query()
            ->where([
                'teacher_id' => auth('api')->id(),
                'status' => CourseStatusEnum::PENDING,
            ])
            ->latest('publishing_request_date')
            ->get();

        return ['data' => CourseForTeacherResource::collection($courses), 'message' => 'Course retrieved successfully', 'code' => 200];
    }

    public function getApprovedCoursesToTeacher(): array
    {
        $courses = Course::query()
            ->where([
                'teacher_id' => auth('api')->id(),
                'status' => CourseStatusEnum::APPROVED,
            ])
            ->withCount('students')
            ->orderBy('rate', 'desc')
            ->orderBy('students_count', 'desc')
            ->get();

        return ['data' => CourseForTeacherResource::collection($courses), 'message' => 'Course retrieved successfully', 'code' => 200];
    }

    public function getRejectedCoursesToTeacher(): array
    {
        $courses = Course::query()
            ->where([
                'teacher_id' => auth('api')->id(),
                'status' => CourseStatusEnum::REJECTED,
            ])
            ->latest('publishing_request_date')
            ->get();

        return ['data' => CourseForTeacherResource::collection($courses), 'message' => 'Course retrieved successfully', 'code' => 200];
    }

    public function publishCourse($id): array
    {
        $course = Course::query()->where([
            'teacher_id' => auth('api')->id(),
            'id' => $id
        ])->first();
        if (is_null($course)) {
            return ['message' => 'Course not found!', 'code' => 404];
        }

        if ($course->num_of_episodes == 0) {
            return ['message' => 'Please add at least one episode before submitting the course for review', 'code' => 422];
        }

        if ($course->status == 'pending') {
            return ['message' => 'Course already submitted for review!', 'code' => 422];
        } else if ($course->status == 'approved') {
            return ['message' => 'Course already published!', 'code' => 422];
        } else if ($course->status === 'rejected') {
            return ['message' => 'This course was rejected and cannot be resubmitted without modifications.', 'code' => 409];
        }

        $course->update([
            'status' => CourseStatusEnum::PENDING,
            'publishing_request_date' => now()
        ]);

        return ['message' => 'Course submitted successfully', 'code' => 200];
    }

    public function evaluation($request, $id): array
    {
        $course = Course::query()->where('status', CourseStatusEnum::APPROVED)->find($id);

        $student_id = auth('api')->id();
        if ($course->students()->where('student_id', $student_id)->whereNot('rate', 0)->exists()) {
            return ['message' => 'You have already evaluated this course!', 'code' => 422];
        }

//        $course->students()->updateExistingPivot($student_id, ['rate' => $request['rate']]);
        $course->students()->sync(
            [
                auth('api')->id() => ['rate' => $request['rate']]
            ], false);
        $course->rate = round($course->students()->pluck('rate')->avg(), 2);
        $course->save();

        return ['data' => new CourseWithDetailsForStudentResource($course), 'message' => 'Course evaluated successfully', 'code' => 200];
    }


}
