<?php

namespace App\Models;

use App\Enums\LevelEnum;
use Illuminate\Database\Eloquent\Model;

class LanguageUser extends Model
{
    protected $casts = [
        'level' => LevelEnum::class
    ];
}
