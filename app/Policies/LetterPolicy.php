<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Letter;
use App\Models\Student;
use App\Models\Training;
use App\Models\TrainingAgency;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Arr;

class LetterPolicy
{
    /**
     * Determine whether the user can store models.
     */
    public function store($user, $training_id): bool
    {
        if (in_array($training_id, $user->letters->pluck('training_id')->toArray())){
            return false;
        }
        return true;
    }

    /**
     * Determine whether the user can accept Letter.
     */
    public function acceptLetter($user, Letter $letter): bool
    {
        if (auth('admin')->user()) {
            return true;
        }
        return $user->id === $letter->training->trainingable->id && $letter->training->trainingable_type === TrainingAgency::class;
    }

    /**
     * Determine whether the user can refuse Letter.
     */
    public function refuseLetter($user, Letter $letter): bool
    {
        if (auth('admin')->user()) {
            return true;
        }
        return $user->id === $letter->training->trainingable->id && $letter->training->trainingable_type === TrainingAgency::class;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete($user, Letter $letter): bool
    {
        if (auth('admin')->user()) {
            return true;
        }
        return $user->id === $letter->letterable->id && $letter->letterable_type === Student::class;
    }
}
