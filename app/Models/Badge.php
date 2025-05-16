<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Badge extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'group',
        'level',
        'description',
        'goal',
        'image_url',
        'admin_id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class);
    }
}
