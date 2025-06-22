<?php

use App\Http\Controllers\Dashboard\AdminProfileController;
use App\Http\Controllers\Dashboard\BadgeController;
use App\Http\Controllers\Dashboard\CourseController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\WebAuthController;
use App\Http\Controllers\dashboard\UserController;
use App\Livewire\CourseManagement;
use App\Livewire\CoursesTabNav;
use App\Livewire\CreateBadge;
use App\Livewire\EditBadge;
use App\Livewire\EditProfile;
use App\Livewire\IndexUsersTabs;
use App\Livewire\LoginForm;
use App\Livewire\RegisterForm;
use App\Livewire\RejectedEpisodes;
use App\Livewire\UserManagement;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return to_route('home');
});


Route::prefix('dashboard')->group(function () {
    Route::middleware('guest:web')->controller(WebAuthController::class)->group(function () {
        Route::get('login', LoginForm::class)->name('dashboard.login');
        Route::post('login', LoginForm::class);
        
        Route::get('register', RegisterForm::class)->name('dashboard.register');
        Route::post('register', RegisterForm::class);
    });

    Route::middleware('auth:web')->group(function () {
        Route::post('logout', [WebAuthController::class, 'logout'])->name('dashboard.logout');
        Route::get('home', [HomeController::class, 'index'])->name('home');
        
        // courses
        Route::prefix('courses')->name('courses.')->controller(CourseController::class)->group(function(){
            Route::get('cates_and_topics',              CourseManagement::class)-> name('cates_and_topics');
            Route::get('active_courses/{cate}/{topic}', 'active_courses')->        name('active_courses');
            Route::get('show_course/{course}',          'show_course')->           name('show_course');
            Route::get('video/{episode_id}',            'video')->                 name('video');
            Route::get('like/{episode}',                'like')->                  name('like');
            Route::get('quiz/{episode}',                'quiz')->                  name('quiz')->withTrashed();
            Route::get('rejected_episodes/{topic}',     RejectedEpisodes::class)-> name('rejected_episodes');
            Route::post('approve/{episode}',            'approve')->               name('approve');
            Route::post('reject/{episode}',             'reject')->                name('reject');
        });
        
        // profile
        Route::get('profile/edit', EditProfile::class)->name('profile.edit');
        Route::prefix('profile')->name('profile.')->controller(AdminProfileController::class)->group(function(){
            Route::get('show', 'show')->name('show');
            Route::delete('delete', 'destroy_account')->name('destroy_account');
        });

        // badges
        Route::prefix('badges')->group(function(){
            Route::get('create', CreateBadge::class)->name('badges.create');
            Route::get('edit/{badge}', EditBadge::class)->name('badges.edit');
            Route::resource('badges', BadgeController::class)->except(['create', 'store', 'edit', 'update']);
        });

        
        // users
        Route::prefix('users')->name('users.')->controller(UserController::class)->group(function(){
            Route::get('{type}',                                 UserManagement::class)->          name('index');
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
//     return to_route('dashboard.login');
// });