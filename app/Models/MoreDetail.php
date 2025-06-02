<?php

namespace App\Models;

use App\Enums\EducationEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MoreDetail extends Model
{
    protected $fillable = [
        'user_id',
        'job_title_id',
        'country_id',
        'linked_in_url',
        'education',
        'university',
        'speciality',
        'work_experience',
        'is_banned',
    ];

    public $timestamps = false;

    protected $casts = [
        'education' => EducationEnum::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class, 'language_user')->withPivot('level');
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'skill_user', 'more_detail_id', 'skill_id');
    }

    public function jobTitle(): BelongsTo
    {
        return $this->belongsTo(JobTitle::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }


}
