<?php

namespace App\Services;

use App\Models\Course;
use App\Traits\AuthorizeActions;
use App\Traits\GetAuthorizedUser;
use Illuminate\Support\Facades\Storage;

class CourseService
{
    use GetAuthorizedUser;
    use AuthorizeActions;

    public function getCourses()
    {
        if ($this->getCurrentGuard() === 'teacher')
        {
            return $this->getAuthUser()->courses;
        }

        return Course::latest()->get();
    }

    public function storeCourse($request)
    {
        $file = $request->file('file');
        $fileName = 'thumbnail.' . $file->getClientOriginalExtension();

        $course = $this->getAuthUser()->courses()->create([
            'name' => $request->name,
            'thumbnail' => $fileName,
        ]);

        $file->storeAs("courses/$course->id", $fileName,'public');
    }

    public function updateCourse($request)
    {
        $course = Course::find($request->course_id);
        $this->authorizeAction('update-course', $course);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete("courses/$course->id/$course->thumbnail");

            $file = $request->file('file');
            $fileName = 'thumbnail.' . $file->getClientOriginalExtension();

            $course->update([
                'name' => $request->name,
                'thumbnail' => $fileName,
            ]);

            $file->storeAs("courses/$course->id", $fileName, 'public');
        } else {
            $course->update([
                'name' => $request->name,
            ]);
        }
    }

    public function destroyCourse($request)
    {
        $course = Course::find($request->course_id);

        if ($course) {
            $this->authorizeAction('delete-course', $course);
            $course->delete();
            Storage::disk('public')->deleteDirectory("courses/$course->id");
            return true;
        }

        return false;
    }
}
