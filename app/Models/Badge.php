<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
