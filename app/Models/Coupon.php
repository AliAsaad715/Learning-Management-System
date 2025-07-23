<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'teacher_id',
        'course_id',
        'code',
        'discount_type',
        'discount_value',
        'expires_at',
        'max_uses',
        'use_count',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'coupon_user', 'coupon_id', 'student_id');
    }

    public function isExpired(): bool
    {
        return now()->greaterThan($this->expires_at);
    }

    public function isFullyUsed(): bool
    {
        return $this->max_uses && $this->use_count == $this->max_uses ? true : false;
    }

    public function isValid() : bool
    {
        return !$this->isExpired() && !$this->isFullyUsed();
    }


}
