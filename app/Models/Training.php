<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Training extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'time'];

    public function letters(): HasMany
    {
        return $this->hasMany(Letter::class);
    }

    public function trainingable(): MorphTo
    {
        return $this->morphTo();
    }
}
