<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait GetAuthorizedUser
{
    public function getCurrentGuard()
    {
        foreach (['admin', 'teacher', 'student', 'trainingAgency'] as $guard) {
            if (auth()->guard($guard)->check()) {
                return $guard;
            }
        }
        return null;
    }

    public function getAuthUser()
    {
        return Auth::guard($this->getCurrentGuard())->user();
    }
}
