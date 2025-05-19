<?php

namespace App\Models;

use App\Enums\LevelEnum;
use Illuminate\Database\Eloquent\Model;

class LanguageUser extends Model
{
//    protected $table = 'language_user';
    public $timestamps = false;
    protected $fillable = [
        'language_id',
        'more_detail_id',
        'level'
    ];

    protected $casts = [
        'level' => LevelEnum::class
    ];
}
