<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class DiscussionReply extends Model
{
    use HasFactory;

    protected $fillable = ['discussion_id', 'body'];

    public function replyable(): MorphTo
    {
        return $this->morphTo();
    }

    public function discussion(): BelongsTo
    {
        return $this->belongsTo(Discussion::class);
    }
}
