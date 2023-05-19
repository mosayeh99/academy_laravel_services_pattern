<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Teacher;
use App\Models\VirtualClassroom;
use Illuminate\Auth\Access\Response;

class VirtualClassroomPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update($user, VirtualClassroom $classroom): bool
    {
        if (auth('admin')->user()) {
            return true;
        }
        return $user->id === $classroom->classroomable->id && $classroom->classroomable_type === Teacher::class;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, VirtualClassroom $classroom): bool
    {
        if (auth('admin')->user()) {
            return true;
        }
        return $user->id === $classroom->classroomable->id && $classroom->classroomable_type === Teacher::class;
    }
}
