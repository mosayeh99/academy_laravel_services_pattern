<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Training;
use App\Models\TrainingAgency;
use Illuminate\Auth\Access\Response;

class TrainingPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update($user, Training $training): bool
    {
        if (auth('admin')->user()) {
            return true;
        }
        return $user->id === $training->trainingable->id && $training->trainingable_type === TrainingAgency::class;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Training $training): bool
    {
        if (auth('admin')->user()) {
            return true;
        }
        return $user->id === $training->trainingable->id && $training->trainingable_type === TrainingAgency::class;
    }
}
