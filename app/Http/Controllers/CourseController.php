<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\StoreCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;
use App\Services\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    private CourseService $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
        $this->middleware('AgencyNotAllowed');
        $this->middleware('StudentNotAllowed')->except('index');
    }

    public function index()
    {
        $courses = $this->courseService->getCourses();
        return view('courses', compact('courses'));
    }

    public function store(StoreCourseRequest $request)
    {
        $this->courseService->storeCourse($request);
        notify()->preset('success', ['message' => 'تمت اضافة الدورة بنجاح']);
        return back();
    }

    public function update(UpdateCourseRequest $request)
    {
        $this->courseService->updateCourse($request);
        notify()->preset('success', ['message' => 'تم تعديل الدورة بنجاح']);
        return back();
    }

    public function destroy(Request $request)
    {
        $isDeleted = $this->courseService->destroyCourse($request);

        if ($isDeleted) {
            notify()->preset('success', ['message' => 'تم حذف الدورة بنجاح']);
            return back();
        }

        return back()->withErrors('الدورة غير موجودة.');
    }
}
