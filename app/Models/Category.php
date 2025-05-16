<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    
    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

}
