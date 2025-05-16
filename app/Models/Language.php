<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public $timestamps = false;

    public function moreDetails()
    {
        return $this->belongsToMany(MoreDetail::class, 'language_user');
    }
}
