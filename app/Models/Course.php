<?php

namespace App\Models;

use App\Enums\LevelEnum;
use App\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use function PHPUnit\Framework\isEmpty;

class Course extends Model
{
    public $timestamps = false;

    protected $casts = [
        'difficulty_level' => LevelEnum::class
    ];

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_user', 'student_id');
    }

    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class);
    }

    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot(): void
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
