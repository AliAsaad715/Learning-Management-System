<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    public $timestamps = false;

    public function episode()
    {
        return $this->belongsTo(Episode::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}
