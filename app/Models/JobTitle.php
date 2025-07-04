<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JobTitle extends Model
{
    public $timestamps = false;

    public function moreDetails(): HasMany
    {
        return $this->hasMany(MoreDetail::class);
    }
}
