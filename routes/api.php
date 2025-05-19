<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
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
    Route::post('change-password','changePassword');
    Route::delete('delete', 'destroy');
});
Route::get('users/show-profile/{id}',[UserController::class,'showProfile']);

Route::controller(ResetPasswordController::class)->prefix('users/password')->group(function () {
    Route::post('email', 'forgotPassword');
    Route::post('code/check', 'checkCode');
    Route::post('reset', 'resetPassword');

});

Route::apiResource('courses', CourseController::class);
Route::apiResource('episodes', EpisodeController::class);
Route::apiResource('comments', CommentController::class);
Route::apiResource('replies', ReplyController::class);
Route::apiResource('quizzes', QuizController::class);
Route::apiResource('questions', QuestionController::class);
Route::get('countries', [CountryController::class, 'index']);
Route::get('languages', [LanguageController::class, 'index']);

