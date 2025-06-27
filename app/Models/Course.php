<?php

namespace App\Models;

use App\Enums\LevelEnum;
use App\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use function PHPUnit\Framework\isEmpty;

class Course extends Model
{
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'topic_id',
        'teacher_id',
        'language_id',
        'title',
        'description',
        'image_url',
        'difficulty_level',
        'num_of_hours',
        'price',
        'rate',
        'num_of_episodes',
        'num_of_students_enrolled',
        'publishing_date',
        'published',
        'has_certificate',
    ];
    protected $casts = [
        'difficulty_level' => LevelEnum::class
    ];

    public static function popular($query)
    {
        return $query->orderBy('rate', 'desc')->limit(5);
    }

    public function calculatePercentageForValueRate($value): string
    {
        return round($this->students()->where('rate', $value)->count() / $this->students()->count() * 100, 2) . '%';
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'course_user', 'course_id', 'student_id');
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(language::class);
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

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($course) {
            $user = $course->teacher;
            if ($user->role != RoleEnum::TEACHER)
                throw new \Exception('User is not teacher');

            if(isEmpty($course->episodes))
                throw new \Exception('Upload one episode at least');
        });
    }
     public function studentSubscribe($userId){
        if($this->price ==0)
            return true;
        return $this->user()->where('student_id',$userId)->exists();
    }

}
