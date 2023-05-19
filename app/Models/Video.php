<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['course_id', 'name', 'path'];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }


    public function discussions(): HasMany
    {
        return $this->hasMany(Discussion::class);
    }
}
