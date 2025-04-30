<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthController::class)->prefix('users')->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::get('logout', 'logout');
    Route::post('reset-password', 'resetPassword');
    Route::delete('delete/{id}', 'deleteUser');
});

Route::controller(UserController::class)->group(function () {
    Route::put('update-profile', 'update');
    Route::post('code','check');
});

Route::apiResource('courses', CourseController::class);
Route::apiResource('episodes', EpisodeController::class);
Route::apiResource('comments', CommentController::class);
Route::apiResource('replies', ReplyController::class);
Route::apiResource('quizzes', QuizController::class);
Route::apiResource('questions', QuestionController::class);
