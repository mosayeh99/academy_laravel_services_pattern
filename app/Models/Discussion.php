<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Discussion extends Model
{
    use HasFactory;

    protected $fillable = ['video_id', 'question'];

    public function discussionable(): MorphTo
    {
        return $this->morphTo();
    }

    public function replies(): HasMany
    {
        return $this->hasMany(DiscussionReply::class);
    }
}
