<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class VirtualClassroom extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'meeting_time', 'meeting_link'];

    public function classroomable(): MorphTo
    {
        return $this->morphTo();
    }
}
