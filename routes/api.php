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
use App\Http\Controllers\App\QuestionController;
use App\Http\Controllers\App\QuizController;
use App\Http\Controllers\App\ReplyController;
use App\Http\Controllers\App\ResetPasswordController;
use App\Http\Controllers\App\SkillController;
use App\Http\Controllers\App\TopicController;
use App\Http\Controllers\App\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->prefix('users')->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::middleware('auth:api')->group(function () {
        Route::get('logout', 'logout');
    });
});

Route::controller(UserController::class)->middleware('auth:api')->prefix('users')->group(function () {
    Route::post('update-profile', 'updateProfile');
    Route::post('update-profile-image', 'updateProfileImage');
    Route::post('change-password','changePassword');
    Route::post('promote-student-to-teacher','promoteStudentToTeacher');
    Route::delete('delete', 'destroy');
});
Route::get('users/{id}',[UserController::class,'showProfile']);

Route::controller(ResetPasswordController::class)->prefix('users/password')->group(function () {
    Route::post('email', 'forgotPassword');
    Route::post('code-check', 'checkCode');
    Route::post('reset', 'resetPassword');
});

Route::controller(OTPController::class)->prefix('users/otp')->group(function () {
    Route::post('resend', 'resendOtp')->middleware('throttle:resend-otp');
    Route::post('verify', 'verifyOtp');
});


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



Route::controller(CategoryController::class)->prefix('category')->group(function(){
    Route::get('index-category', 'indexCategory');
});

Route::controller(TopicController::class)->prefix('topic')->group(function(){
    Route::get('topic-in-category/{id}','indexTopics');
    Route::get('searsh-topic/{title}','searchTopic');
});

Route::controller(CourseController::class)->prefix('course')->group(function(){
    Route::get('course-in-topic/{id}','indexCourse');
    Route::get('searsh-course/{title}','searchCourse');
    Route::get('free-course','freeCourse');
    Route::get('paid-course','paidCourse');
    Route::get('all-course','showAllCourses');
});



Route::controller(EpisodeController::class)->middleware('auth:api')->prefix('episode')->group(function(){
    Route::get('episodes-in-course/{id}','indexEpisode');
    Route::get('episode/{id}','showEpisode');

});


Route::apiResource('comments', CommentController::class);

Route::apiResource('replies', ReplyController::class);

Route::get('countries', [CountryController::class, 'index']);

Route::get('languages', [LanguageController::class, 'index']);

Route::get('skills', [SkillController::class, 'index']);

Route::get('job_titles', [JobTitleController::class, 'index']);

Route::controller(EnumController::class)->group(function () {
    Route::get('levels', 'levels');
    Route::get('educations', 'educations');
});

