<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function episode()
    {
        return $this->belongsTo(Episode::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    
    public function userlikes()
    {
        return $this->belongsToMany(User::class, 'commentlikes');
    }
}
