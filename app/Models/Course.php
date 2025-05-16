<?php

namespace App\Models;

use App\Enums\LevelEnum;
use App\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Model;

use function PHPUnit\Framework\isEmpty;

class Course extends Model
{
    public $timestamps = false;

    protected $casts = [
        'difficulty_level' => LevelEnum::class
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user', 'student_id');
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($course) {
            $user = $course->teacher;
            if ($user->role != RoleEnum::TEACHER)
                throw new \Exception('User is not teacher');

            if (isEmpty($course->episodes))
                throw new \Exception('Upload one episode at least');
        });
    }
}
