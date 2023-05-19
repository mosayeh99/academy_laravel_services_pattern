<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'body'];

    public function articleable(): MorphTo
    {
        return $this->morphTo();
    }
}
