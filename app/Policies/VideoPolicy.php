<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Video;
use Illuminate\Auth\Access\Response;

class VideoPolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view($user, Course $course, Video $video = null): bool
    {
        if (auth('admin')->user() || auth('student')->user()) {
            return true;
        }

        if ($video) {
            return $user->id === $video->course->courseable->id && $video->course->courseable_type === Teacher::class;
        }

        return $user->id === $course->courseable->id && $course->courseable_type === Teacher::class;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Video $video): bool
    {
        if (auth('admin')->user()) {
            return true;
        }
        return $user->id === $video->course->courseable->id && $video->course->courseable_type === Teacher::class;
    }

    /**
     * Determine whether the user can Delete the model.
     */
    public function delete($user, Video $video): bool
    {
        if (auth('admin')->user()) {
            return true;
        }
        return $user->id === $video->course->courseable->id && $video->course->courseable_type === Teacher::class;
    }
}
