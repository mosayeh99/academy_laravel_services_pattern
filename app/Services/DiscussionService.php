<?php

namespace App\Services;

use App\Models\Discussion;
use App\Traits\AuthorizeActions;
use App\Traits\GetAuthorizedUser;

class DiscussionService
{
    use GetAuthorizedUser;
    use AuthorizeActions;

    public function storeDiscussion($request)
    {
        $this->getAuthUser()->discussions()->create($request);
    }

    public function destroyDiscussion($request)
    {
        $discussion = Discussion::find($request->discussion_id);

        if ($discussion) {
            $this->authorizeAction('delete-discussion', $discussion);
            $discussion->delete();
            return true;
        }

        return false;
    }
}
