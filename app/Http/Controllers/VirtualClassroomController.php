<?php

namespace App\Http\Controllers;

use App\Http\Requests\VirtualClassrooms\StoreClassroomRequest;
use App\Http\Requests\VirtualClassrooms\UpdateClassroomRequest;
use App\Services\VirtualClassroomService;
use App\Traits\AuthorizeActions;
use App\Traits\GetAuthorizedUser;
use Illuminate\Http\Request;

class VirtualClassroomController extends Controller
{
    use GetAuthorizedUser, AuthorizeActions;

    private VirtualClassroomService $classroomService;

    public function __construct(VirtualClassroomService $virtualClassroomService)
    {
        $this->classroomService = $virtualClassroomService;
        $this->middleware('AgencyNotAllowed');
        $this->middleware('StudentNotAllowed')->except('index');
    }

    public function index()
    {
        $classrooms = $this->classroomService->getClassrooms();
        return view('virtual_classrooms', compact('classrooms'));
    }

    public function store(StoreClassroomRequest $request)
    {
        $this->classroomService->storeClassroom($request->validated());
        notify()->preset('success', ['message' => 'تمت اضافة الفصل بنجاح']);
        return back();
    }

    public function update(UpdateClassroomRequest $request)
    {
        $this->classroomService->updateClassroom($request);
        notify()->preset('success', ['message' => 'تم تعديل الفصل بنجاح']);
        return back();
    }

    public function destroy(Request $request)
    {
        $isDeleted = $this->classroomService->destroyClassroom($request);

        if ($isDeleted) {
            notify()->preset('success', ['message' => 'تم حذف الفصل بنجاح']);
            return back();
        }

        return back()->withErrors('الفصل غير موجود.');
    }
}
