<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Episode extends Model
{
    use SoftDeletes;
    
    public $timestamps = false;
    
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function quiz()
    {
        return $this->hasOne(Quiz::class);
    }
    
    public function admin()
    {
        return $this->belongsTo(User::class);
    }

    public function userlikes()
    {
        return $this->belongsToMany(User::class, 'episodelikes');
    }
}
