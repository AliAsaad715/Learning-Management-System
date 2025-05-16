<?php

namespace App\Models;

use App\Enums\EducationEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MoreDetail extends Authenticatable
{
    public $timestamps = false;

    protected $casts = [
        'education' => EducationEnum::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'language_user');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'skill_user', 'more_detail_id', 'skill_id');
    }

    public function jobTitle()
    {
        return $this->belongsTo(JobTitle::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

  
}
