<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    public $timestamps = false;

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function badges()
    {
        return $this->hasMany(Badge::class);
    }
}
