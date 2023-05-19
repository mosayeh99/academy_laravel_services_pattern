<?php

namespace App\Http\Controllers;

use App\Http\Requests\Discussion\StoreReplyRequest;
use App\Traits\GetAuthorizedUser;

class DiscussionReplyController extends Controller
{
    use GetAuthorizedUser;

    public function __construct()
    {
        $this->middleware('AgencyNotAllowed');
    }

    public function store(StoreReplyRequest $request)
    {
        $this->getAuthUser()->replies()->create($request->validated());
        notify()->preset('success', ['message' => 'تم اضافة الرد بنجاح.']);
        return back();
    }
}
