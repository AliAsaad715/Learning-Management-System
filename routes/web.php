<?php

use App\Http\Controllers\Dashboard\AdminProfileController;
use App\Http\Controllers\Dashboard\BadgeController;
use App\Http\Controllers\Dashboard\CourseController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\WebAuthController;
use App\Http\Controllers\dashboard\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('home');
});


Route::prefix('dashboard')->group(function () {
    Route::middleware('guest:web')->controller(WebAuthController::class)->group(function () {
        Route::get('login', 'showLoginForm')->name('dashboard.login');
        Route::post('login', 'login');
        
        Route::get('register', 'showRegistrationForm')->name('dashboard.register');
        Route::post('register', 'register');
    });

    Route::middleware('auth:web')->group(function () {
        Route::post('logout', [WebAuthController::class, 'logout'])->name('dashboard.logout');
        Route::get('home', [HomeController::class, 'index'])->name('home');
        
        // courses
        Route::prefix('courses')->name('courses.')->controller(CourseController::class)->group(function(){
            Route::get('cates_and_topics',              'cates_and_topics')-> name('cates_and_topics');
            Route::get('active_courses/{cate}/{topic}', 'active_courses')->   name('active_courses');
            Route::get('show_course/{course}',          'show_course')->      name('show_course');
            Route::get('video/{episode_id}',            'video')->            name('video');
            Route::get('like/{episode}',                'like')->             name('like');
            Route::get('quiz/{episode}',                'quiz')->             name('quiz')->withTrashed();
            Route::get('rejected_episodes/{topic}',     'rejected_episodes')->name('rejected_episodes');
            Route::post('approve/{episode}',            'approve')->          name('approve');
            Route::post('reject/{episode}',             'reject')->           name('reject');
            Route::post('republish/{episode}',          'republish')->        name('republish')->withTrashed();
        });
        
        // profile
        Route::get('profile/delete_profile_image', [AdminProfileController::class, 'destroy_profile_image'])->name('profile.destroy_profile_image');
        Route::singleton('profile', AdminProfileController::class)->destroyable()->names([
            'destroy' => 'profile.destroy_account'
        ]);

        // badges
        Route::prefix('badges')->resource('badges', BadgeController::class);
        
        // users
        Route::prefix('users')->name('users.')->controller(UserController::class)->group(function(){
            Route::get('{type}',                                 'index')->          name('index');
            Route::get('show_user/{user_id}',                    'show_user')->      name('show_user');
            Route::get('followed_courses/{user_id}/{course_id}', 'followed_course')->name('followed_course');
            Route::get('show_teacher/{teacher_id}',              'show_teacher')->   name('show_teacher');
            Route::delete('ban/{user}',                          'ban_user')->       name('ban');
            Route::get('unban/{user}',                           'unban_user')->     name('unban')->withTrashed();
        });
    });
});

// for test
// Route::get('restore', function(){
//     User::withTrashed()->find(1)->restore();
//     return view('auth.login');
// });