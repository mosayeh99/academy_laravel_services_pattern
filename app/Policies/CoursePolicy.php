<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\Teacher;

class CoursePolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Course $course): bool
    {
        if (auth('admin')->user()) {
            return true;
        }
        return $user->id === $course->courseable->id && $course->courseable_type === Teacher::class;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Course $course): bool
    {
        if (auth('admin')->user()) {
            return true;
        }
        return $user->id === $course->courseable->id && $course->courseable_type === Teacher::class;
    }

}
