<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    public $timestamps = false;

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }
}
