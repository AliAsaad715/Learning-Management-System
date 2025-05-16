<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    public $timestamps = false;

    public function moreDetails()
    {
        return $this->belongsToMany(MoreDetail::class, 'skill_user', 'skill_id', 'more_detail_id');
    }
}
