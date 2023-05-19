<?php

namespace App\Services;

use App\Models\VirtualClassroom;
use App\Traits\AuthorizeActions;
use App\Traits\GetAuthorizedUser;

class VirtualClassroomService
{
    use GetAuthorizedUser;
    use AuthorizeActions;

    public function getClassrooms()
    {
        $teacher = auth('teacher')->user();

        if ($teacher) {
            return $teacher->classrooms;
        }

        return VirtualClassroom::latest()->get();
    }

    public function storeClassroom($request)
    {
        $this->getAuthUser()->classrooms()->create($request);
    }

    public function updateClassroom($request)
    {
        $classroom = VirtualClassroom::find($request->classroom_id);
        $this->authorizeAction('update-classroom', $classroom);
        $classroom->update($request->validated());
    }

    public function destroyClassroom($request)
    {
        $classroom = VirtualClassroom::find($request->classroom_id);

        if ($classroom) {
            $this->authorizeAction('delete-classroom', $classroom);
            $classroom->delete();
            return true;
        }

        return false;
    }
}
