<?php

namespace App\Http\Controllers;

use App\Http\Requests\Training\StoreTrainingRequest;
use App\Http\Requests\Training\UpdateTrainingRequest;
use App\Services\TrainingService;
use Illuminate\Http\Request;

class TrainingController extends Controller
{
    private TrainingService $trainingService;

    public function __construct(TrainingService $trainingService)
    {
        $this->trainingService = $trainingService;
        $this->middleware('TeacherNotAllowed');
        $this->middleware('StudentNotAllowed')->except('index');
    }

    public function index()
    {
        $data = $this->trainingService->getTrainings();
        return view('trainings', $data);
    }

    public function store(StoreTrainingRequest $request)
    {
        $this->trainingService->storeTraining($request->validated());
        notify()->preset('success', ['message' => 'تم اضافة التدريب بنجاح']);
        return back();
    }

    public function update(UpdateTrainingRequest $request)
    {
        $this->trainingService->updateTraining($request);
        notify()->preset('success', ['message' => 'تم تعديل التدريب بنجاح']);
        return back();
    }

    public function destroy(Request $request)
    {
        $isDeleted = $this->trainingService->destroyTraining($request);

        if ($isDeleted) {
            notify()->preset('success', ['message' => 'تم حذف التدريب بنجاح']);
            return back();
        }

        return back()->withErrors('التدريب غير متوفر.');
    }
}
