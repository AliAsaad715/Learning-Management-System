<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as EloquentModel;

abstract class Model extends EloquentModel
{
    /**
     * Add global behaviors or methods shared by ALL your models
     * Example: Custom UUID trait, logging, etc.
     */
}