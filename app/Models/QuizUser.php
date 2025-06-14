<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class QuizUser extends Model
{
    protected $table = 'quiz_user';

    public $timestamps = false;

    protected $fillable = [
        'mark',
        'percentage_mark',
        'success'
    ];

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'answers')->withPivot('is_correct');
    }


}
