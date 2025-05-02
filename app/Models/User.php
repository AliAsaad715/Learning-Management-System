<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\EducationEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
 
    public $timestamps = false;
    
    protected $casts = [
        'education' => EducationEnum::class
    ];

    protected $fillable = [
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function job_title()
    {
        return $this->belongsTo(JobTitle::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function published_courses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    public function followed_courses()
    {
        return $this->belongsToMany(Course::class, 'student_id');
    }

    public function statistics()
    {
        return $this->belongsToMany(Statistic::class);
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class);
    }

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }


    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'completed_courses');
    }
}
