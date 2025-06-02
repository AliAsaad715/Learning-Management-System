<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    public $timestamps = false;



    protected $fillable = [
        'first_name',
        'last_name',
        'profile_image_url',
        'email',
        'password',
        'role',
    ];

    protected $casts = [
        'role' => RoleEnum::class,  
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function moreDetail()
    {
        return $this->hasOne(MoreDetail::class);
    }

    public function adminBadges()
    {
        return $this->hasMany(Badge::class);
    }

    public function adminCourses()
    {
        return $this->hasMany(Episode::class);
    }

      public function published_courses()
    {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    public function followed_courses()
    {
        return $this->belongsToMany(Course::class, 'course_user', 'student_id')->withPivot(['perc_progress', 'progress', 'num_of_completed_quizzes', 'purchase_date','rate']);
    }

    public function statistics()
    {
        return $this->belongsToMany(Statistic::class)->withPivot('progress');
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

    public function likeEpisode()
    {
        return $this->belongsToMany(Episode::class, 'episodelikes');
    }

    public function likeComment()
    {
        return $this->belongsToMany(Comment::class, 'commentlikes');
    }

    public function likeReply()
    {
        return $this->belongsToMany(Reply::class, 'replylikes');
    }
}
