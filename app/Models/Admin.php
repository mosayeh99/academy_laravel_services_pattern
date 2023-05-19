<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function courses(): MorphMany
    {
        return $this->morphMany(Course::class, 'courseable');
    }

    public function discussions(): MorphMany
    {
        return $this->morphMany(Discussion::class, 'discussionable');
    }

    public function replies(): MorphMany
    {
        return $this->morphMany(DiscussionReply::class, 'replyable');
    }

    public function letters(): MorphMany
    {
        return $this->morphMany(Letter::class, 'letterable');
    }

    public function trainings(): MorphMany
    {
        return $this->morphMany(Training::class, 'trainingable');
    }

    public function classrooms(): MorphMany
    {
        return $this->morphMany(VirtualClassroom::class, 'classroomable');
    }

    public function articles(): MorphMany
    {
        return $this->morphMany(Article::class, 'articleable');
    }
}
