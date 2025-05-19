<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'profile_image_url',
        'email',
        'password',
        'role',
        'otp_code',
        'expire_at'
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

    public function setFirstNameAttribute($value): void
    {
        $this->attributes['first_name'] = ucfirst(strtolower($value));
    }

    public function setLastNameAttribute($value): void
    {
        $this->attributes['last_name'] = ucfirst(strtolower($value));
    }

    public function moreDetail(): HasOne
    {
        return $this->hasOne(MoreDetail::class);
    }

    public function adminBadges(): HasMany
    {
        return $this->hasMany(Badge::class);
    }

    public function adminCourses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

      public function published_courses(): HasMany
      {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    public function followed_courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class, 'course_user', 'student_id');
    }

    public function statistics(): BelongsToMany
    {
        return $this->belongsToMany(Statistic::class)->withPivot('progress');
    }

    public function badges(): BelongsToMany
    {
        return $this->belongsToMany(Badge::class);
    }

    public function quizzes(): BelongsToMany
    {
        return $this->belongsToMany(Quiz::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Reply::class);
    }

    public function topics(): BelongsToMany
    {
        return $this->belongsToMany(Topic::class, 'completed_courses');
    }

    public function sendOtp($user) {
        $user->otp_code = rand(100000, 999999);
        $user->expire_at = now()->addMinutes(10);
        $user->save();

//        Mail::raw("Your OTP code is: $user->otp_code", function ($message) use ($user) {
//            $message->to($user->email)
//                ->subject('Verification Code');
//        });
        Mail::to($user->email)->queue(new OtpMail($user->otp_code));
        return response()->json(['message' => 'OTP sent successfully.'], 200);
    }
}
