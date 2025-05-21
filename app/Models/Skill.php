<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    public $timestamps = false;

    public function moreDetails(): BelongsToMany
    {
        return $this->belongsToMany(MoreDetail::class, 'skill_user', 'skill_id', 'more_detail_id');
    }
}
