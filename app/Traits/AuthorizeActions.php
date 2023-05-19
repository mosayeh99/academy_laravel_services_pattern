<?php

namespace App\Traits;

use Illuminate\Support\Facades\Gate;

trait AuthorizeActions
{
    use GetAuthorizedUser;

    public function authorizeAction($ability, ...$arguments): void
    {
        if (Gate::forUser($this->getAuthUser())->denies($ability, $arguments)) {
            abort(403);
        }
    }
}
