<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Episode extends Model
{
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = [
        'course_id',
        'title',
        'episode_number',
        'video_url',
        'duration',
        'image_url',
        'views',
        'likes'
    ];

    public function getFormattedDurationAttribute(): string
    {
        $seconds = $this->duration;
        return gmdate("i:s", $seconds);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function quiz(): HasOne
    {
        return $this->hasOne(Quiz::class);
    }

    public function userLikes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'episode_likes');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'episode_user')->withPivot('pass_quiz');
    }
}
