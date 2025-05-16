<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public $timestamps = false;

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'completed_courses');
    }
}
