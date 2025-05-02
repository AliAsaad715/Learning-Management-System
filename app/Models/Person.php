<?php

namespace App\Models;

use App\Enums\RoleEnum;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    public $timestamps = false;

    protected $casts = [
        'role' => RoleEnum::class,
    ];

    public function user()
    {
        return $this->has(User::class);
    }

    public function admin()
    {
        return $this->has(Admin::class);
    }
}
