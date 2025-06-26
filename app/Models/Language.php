<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Language extends Model
{
    public $timestamps = false;

    public function moreDetails(): BelongsToMany
    {
        return $this->belongsToMany(MoreDetail::class, 'language_user');
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'language_id');
    }
}
