<?php

namespace App\Services;

use App\Models\Letter;
use App\Models\Training;
use App\Traits\AuthorizeActions;
use App\Traits\GetAuthorizedUser;
use Carbon\Carbon;

class TrainingService
{
    use GetAuthorizedUser;
    use AuthorizeActions;

    public function getTrainings()
    {
        Carbon::setLocale('ar');
        $agency = auth('trainingAgency')->user();
        $student = auth('student')->user();

        if ($agency) {
            $trainings = $agency->trainings;
            $letters = $agency->letters->whereNull('status')->load('training');
            return ['trainings' => $trainings, 'letters' => $letters];
        }

        if ($student) {
            $letters = $student->letters->load('training');
            $trainingsIds = $letters->pluck('training_id');
            $trainings = Training::whereNotIn('id', $trainingsIds)->latest()->get();
            return ['trainings' => $trainings, 'letters' => $letters];
        }

        $trainings = Training::latest()->get();
        $letters = Letter::with('training')->latest()->get();
        return ['trainings' => $trainings, 'letters' => $letters];
    }

    public function storeTraining($request)
    {
        $this->getAuthUser()->trainings()->create($request);
    }

    public function updateTraining($request)
    {
        $training = Training::find($request->training_id);
        $this->authorizeAction('update-training', $training);
        $training->update($request->validated());
    }

    public function destroyTraining($request)
    {
        $training = Training::find($request->training_id);

        if ($training) {
            $this->authorizeAction('delete-training', $training);
            $training->delete();
            return true;
        }

        return false;
    }
}
