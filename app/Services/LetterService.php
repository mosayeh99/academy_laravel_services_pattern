<?php

namespace App\Services;

use App\Models\Letter;
use App\Traits\AuthorizeActions;
use App\Traits\GetAuthorizedUser;

class LetterService
{
    use GetAuthorizedUser;
    use AuthorizeActions;

    public function storeLetter($request)
    {
        $this->authorizeAction('store-letter', $request->validated('training_id'));
        $this->getAuthUser()->letters()->create($request->validated());
    }

    public function acceptLetter($request)
    {
        $letter = Letter::find($request->letter_id);

        if ($letter) {
            $this->authorizeAction('accept-letter', $letter);
            $letter->update([
                'status' => '1'
            ]);
            return true;
        }

        return false;
    }

    public function refuseLetter($request)
    {
        $letter = Letter::find($request->letter_id);

        if ($letter) {
            $this->authorizeAction('refuse-letter', $letter);
            $letter->update([
                'status' => '0'
            ]);
            return true;
        }

        return false;
    }

    public function destroyLetter($request)
    {
        $letter = Letter::find($request->letter_id);

        if ($letter) {
            $this->authorizeAction('delete-letter', $letter);
            $letter->delete();
            return true;
        }

        return false;
    }
}
