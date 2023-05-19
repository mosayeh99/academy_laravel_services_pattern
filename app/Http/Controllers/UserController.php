<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\DeleteUserRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\UserService;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $data = $this->userService->getusers();
        return view('users', $data);
    }

    public function store(StoreUserRequest $request)
    {
        $this->userService->storeUser($request);
        notify()->preset('success', ['message' => 'تم اضافة المستخدم بنجاح']);
        return back();
    }

    public function update(UpdateUserRequest $request)
    {
        $this->userService->updateUser($request);
        notify()->preset('success', ['message' => 'تم تعديل المستخدم بنجاح']);
        return back();
    }

    public function destroy(DeleteUserRequest $request)
    {
        $this->userService->destroyUser($request);
        notify()->preset('success', ['message' => 'تم حذف المستخدم بنجاح']);
        return back();
    }
}
