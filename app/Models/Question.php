<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $timestamps = false;
    
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
