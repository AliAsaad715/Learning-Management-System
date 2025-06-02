<?php

use App\Http\Controllers\Dashboard\AdminProfileController;
use App\Http\Controllers\Dashboard\BadgeController;
use App\Http\Controllers\Dashboard\CourseController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\RegisterController;
use App\Http\Controllers\dashboard\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('home');
});


Route::prefix('dashboard')->group(function () {
    Route::middleware('guest:web')->group(function () {
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('dashboard.login');
        Route::post('login', [LoginController::class, 'login']);
        
        Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('dashboard.register');
        Route::post('register', [RegisterController::class, 'register']);
    });

    Route::middleware('auth:web')->group(function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('dashboard.logout');
        Route::get('home', [HomeController::class, 'index'])->name('home');
        
        // courses
        Route::prefix('courses')->group(function(){
            Route::get('cates_and_topics', [CourseController::class, 'cates_and_topics'])->name('courses.cates_and_topics');
            Route::get('active_courses/{cate}/{topic}', [CourseController::class, 'active_courses'])->name('courses.active_courses');
            Route::get('show_course/{course}', [CourseController::class, 'show_course'])->name('courses.show_course');
            Route::get('video/{episode_id}', [CourseController::class, 'video'])->name('courses.video');
            Route::get('like/{episode}', [CourseController::class, 'like'])->name('courses.like');
            Route::get('quiz/{episode_id}', [CourseController::class, 'quiz'])->name('courses.quiz');
            Route::get('rejected_episodes/{topic}', [CourseController::class, 'rejected_episodes'])->name('courses.rejected_episodes');
            Route::post('approve/{episode}', [CourseController::class, 'approve'])->name('courses.approve');
            Route::post('reject/{episode}', [CourseController::class, 'reject'])->name('courses.reject');
            Route::post('republish/{episode_id}', [CourseController::class, 'republish'])->name('courses.republish');
        });
        
        // profile
        Route::prefix('profile')->group(function () {
            // Admin profile routes
            Route::get('', [AdminProfileController::class, 'show'])->name('profile.show');
            Route::get('edit', [AdminProfileController::class, 'edit'])->name('profile.edit');
            Route::put('', [AdminProfileController::class, 'update'])->name('profile.update');
            Route::get('delete_profile_image', [AdminProfileController::class, 'destroy_profile_image'])->name('profile.destroy_profile_image');
            Route::delete('delete_account', [AdminProfileController::class, 'destroy_account'])->name('profile.destroy_account');
        });

        // badges
        Route::prefix('badges')->group(function(){
            Route::get('', [BadgeController::class, 'index'])->name('badges.index');
            Route::get('create', [BadgeController::class, 'create'])->name('badges.create');
            Route::post('', [BadgeController::class, 'store'])->name('badges.store');
            Route::get('{badge}', [BadgeController::class, 'show'])->name('badges.show');
            Route::get('{badge}/edit', [BadgeController::class, 'edit'])->name('badges.edit');
            Route::put('{badge}', [BadgeController::class, 'update'])->name('badges.update');
            Route::delete('{badge}', [BadgeController::class, 'destroy'])->name('badges.destroy');
        });
        
        // users
        Route::prefix('users')->group(function(){
            Route::get('{type}', [UserController::class, 'index'])->name('users.index');
            Route::get('show_user/{user_id}', [UserController::class, 'show_user'])->name('users.show_user');
            Route::get('followed_courses/{user_id}/{course_id}', [UserController::class, 'followed_course'])->name('users.followed_course');
            Route::get('show_teacher/{teacher_id}', [UserController::class, 'show_teacher'])->name('users.show_teacher');
            Route::delete('ban/{user}', [UserController::class, 'ban_user'])->name('users.ban');
            Route::get('unban/{user_id}', [UserController::class, 'unban_user'])->name('users.unban');
        });
    });
});

Route::get('restore', function(){
    User::withTrashed()->find(1)->restore();
    return view('auth.login');
});