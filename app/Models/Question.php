<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'question_number',
        'content',
        'answer_a',
        'answer_b',
        'answer_c',
        'answer_d',
        'explanation',
        'right_answer',
    ];

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function quiz_users(): BelongsToMany
    {
        return $this->belongsToMany(QuizUser::class, 'answers');
    }
}
