<?php


use App\Http\Controllers\App\JobTitleController;
use App\Http\Controllers\App\AuthController;
use App\Http\Controllers\App\CategoryController;
use App\Http\Controllers\App\CommentController;
use App\Http\Controllers\App\CountryController;
use App\Http\Controllers\App\CourseController;
use App\Http\Controllers\App\EnumController;
use App\Http\Controllers\App\EpisodeController;
use App\Http\Controllers\App\LanguageController;
use App\Http\Controllers\App\OTPController;
use App\Http\Controllers\App\QuizController;
use App\Http\Controllers\App\ReplyController;
use App\Http\Controllers\App\ResetPasswordController;
use App\Http\Controllers\App\SkillController;
use App\Http\Controllers\App\TopicController;
use App\Http\Controllers\App\UserController;
use Illuminate\Support\Facades\Route;

// auth
Route::controller(AuthController::class)->prefix('users')->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::middleware('auth:api')->group(function () {
        Route::get('logout', 'logout');
    });
});

// profile
Route::controller(UserController::class)->middleware('auth:api')->prefix('users')->group(function () {
    Route::post('update-profile', 'updateProfile');
    Route::post('update-profile-image', 'updateProfileImage');
    Route::post('change-password', 'changePassword');
    Route::post('promote-student-to-teacher', 'promoteStudentToTeacher');
    Route::delete('delete', 'destroy');
    Route::post('store-fcm-token', 'storeFCMToken');
});
Route::get('users/{id}', [UserController::class, 'showProfile']);

// reset password
Route::controller(ResetPasswordController::class)->prefix('users/password')->group(function () {
    Route::post('email', 'forgotPassword');
    Route::post('code-check', 'checkCode');
    Route::post('reset', 'resetPassword');
});

// otp
Route::controller(OTPController::class)->prefix('users/otp')->group(function () {
    Route::post('resend', 'resendOtp')->middleware('throttle:resend-otp');
    Route::post('verify', 'verifyOtp');
});

// quizzes
Route::controller(QuizController::class)->middleware('auth:api')->prefix('quizzes')->group(function () {
    Route::middleware('isTeacher')->group(function () {
        Route::post('', 'store');
        Route::get('{episode_id}', 'show');
    });
    Route::post('start-quiz/{episode_id}', 'startQuiz');
    Route::post('process-answer', 'processAnswer');
    Route::put('result/{quiz_id}', 'calculateQuizResult');
    Route::get('result/{quiz_id}', 'getQuizResult');
});

// categories
Route::controller(CategoryController::class)->prefix('categories')->group(function () {
    Route::get('', 'index');
    Route::get('search/{title}', 'search');
});

// topics
Route::controller(TopicController::class)->prefix('topics')->group(function () {
    Route::get('{category_id}', 'index');
    Route::get('search/{title}', 'search');
});

// courses
Route::controller(CourseController::class)->prefix('courses')->group(function () {
    Route::get('', 'index');
    Route::post('load-more', 'loadMore');
    Route::get('category/{category_id}', 'getCoursesForCategory');
    Route::get('topic/{topic_id}', 'getCoursesForTopic');
    Route::get('language/{language_id}', 'getCoursesForLanguage');
    Route::get('search/{title}', 'search');
    Route::get('free', 'getFreeCourses');
    Route::get('paid', 'getPaidCourses');
    Route::get('student/{id}', 'showToStudent');
    Route::middleware('auth:api')->group(function () {
        Route::middleware('isTeacher')->group(function () {
            Route::get('draft', 'getDraftCoursesToTeacher');
            Route::get('pending', 'getPendingCoursesToTeacher');
            Route::get('approved', 'getApprovedCoursesToTeacher');
            Route::get('rejected', 'getRejectedCoursesToTeacher');
            Route::post('', 'store');
            Route::get('teacher/{id}', 'showToTeacher');
            Route::post('publish/{course_id}', 'publishCourse');
        });
        Route::post('evaluation/{id}', 'evaluation')->middleware('isSubscribed');
    });
});

// episodes
Route::controller(EpisodeController::class)->middleware(['auth:api', 'isTeacher'])->prefix('episodes')->group(function () {
    Route::middleware('isSubscribed')->group(function () {
        Route::get('{course_id}', 'indexToStudent');
        Route::get('{id}', 'show');
    });
    Route::post('{course_id}', 'store');
});

// comments
Route::controller(CommentController::class)->middleware('auth:api')->prefix('comments')->group(function () {
    Route::get('{episode_id}', 'index');
    Route::post('load-more/{episode_id}', 'loadMore');
    Route::get('get-my-comments/{episode_id}', 'getMyComments');
    Route::post('{episode_id}', 'store');
    Route::put('{id}', 'update');
    Route::delete('{id}', 'destroy');
    Route::post('add-like/{id}', 'addLikeToComment');
    Route::delete('remove-like/{id}', 'removeLikeFromComment');
});

// replies
Route::controller(ReplyController::class)->middleware('auth:api')->prefix('replies')->group(function () {
    Route::get('{comment_id}', 'index');
    Route::post('{comment_id}', 'store');
    Route::put('{id}', 'update');
    Route::delete('{id}', 'destroy');
    Route::post('add-like/{id}', 'addLikeToReply');
    Route::delete('remove-like/{id}', 'removeLikeFromReply');
});

// constant values
Route::get('countries', [CountryController::class, 'index']);

Route::get('languages', [LanguageController::class, 'index']);

Route::get('skills', [SkillController::class, 'index']);

Route::get('job_titles', [JobTitleController::class, 'index']);

Route::controller(EnumController::class)->group(function () {
    Route::get('levels', 'levels');
    Route::get('educations', 'educations');
});

