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

    public function calculateQuizResult(): array
    {
        $correctAnswers = $this->questions()->where('is_correct', 1)->count();
        $data['mark'] = $correctAnswers;
        $data['percentage_mark'] = round($correctAnswers / $this->questions()->count() * 100, 2);
        $data['success'] = $data['percentage_mark'] >= 60 ? 1 : 0;
        return $data;
    }
}
