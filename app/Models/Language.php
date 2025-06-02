<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Language extends Model
{
    public $timestamps = false;

    public function moreDetails(): BelongsToMany
    {
        return $this->belongsToMany(MoreDetail::class, 'language_user');
    }
}
