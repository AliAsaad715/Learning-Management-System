<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public $timestamps = false;

    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class);
    }

}
