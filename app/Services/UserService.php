<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TrainingAgency;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getusers()
    {
        return [
            'students' => Student::latest()->get(),
            'teachers' => Teacher::latest()->get(),
            'agencies' => TrainingAgency::latest()->get(),
            'admins' => Admin::latest()->get(),
        ];
    }

    public function storeUser($request)
    {
        $userInfo = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        if ($request->role === 'Admin') {
            $user = Admin::create($userInfo);
        } elseif ($request->role === 'Teacher') {
            $user = Teacher::create($userInfo);
        } else {
            $user = TrainingAgency::create($userInfo);
        }

        $user->assignRole($request->role);
    }

    public function updateUser($request)
    {
        $userInfo = [
            'name' => $request->name,
            'email' => $request->email
        ];

        if ($request->filled('password')) {
            $userInfo = array_merge($userInfo, ['password' => Hash::make($request->password)]);
        }

        if ($request->role === 'Admin') {
            Admin::find($request->user_id)->update($userInfo);
        } elseif ($request->role === 'Teacher') {
            Teacher::find($request->user_id)->update($userInfo);
        } else {
            TrainingAgency::find($request->user_id)->update($userInfo);
        }
    }

    public function destroyUser($request)
    {
        if ($request->role === 'Admin') {
            $user = Admin::find($request->user_id);
        } elseif ($request->role === 'Student') {
            $user = Student::find($request->user_id);
        } elseif ($request->role === 'Teacher') {
            $user = Teacher::find($request->user_id);
        } else {
            $user = TrainingAgency::find($request->user_id);
        }

        $user->removeRole($request->role);
        $user->delete();
    }
}
