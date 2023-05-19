<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Discussion;
use App\Models\Teacher;
use Illuminate\Auth\Access\Response;

class DiscussionPolicy
{
    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Discussion $discussion): bool
    {
        if (auth('admin')->user()) {
            return true;
        }
        return $user->id === $discussion->discussionable->id && $discussion->discussionable_type === Teacher::class;
    }
}
