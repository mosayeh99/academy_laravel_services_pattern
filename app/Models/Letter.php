<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = ['training_id', 'body', 'status'];

    public function training(): BelongsTo
    {
        return $this->belongsTo(Training::class);
    }

    public function letterable(): MorphTo
    {
        return $this->morphTo();
    }
}
