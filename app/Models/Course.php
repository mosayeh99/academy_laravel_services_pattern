<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'thumbnail'];

    public function courseable(): MorphTo
    {
        return $this->morphTo();
    }

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }
}
