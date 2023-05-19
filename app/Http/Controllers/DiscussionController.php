<?php

namespace App\Http\Controllers;

use App\Http\Requests\Discussion\StoreDiscussionRequest;
use App\Services\DiscussionService;
use Illuminate\Http\Request;

class DiscussionController extends Controller
{
    private DiscussionService $discussionService;

    public function __construct(DiscussionService $discussionService)
    {
        $this->discussionService = $discussionService;
        $this->middleware('AgencyNotAllowed');
        $this->middleware('StudentNotAllowed')->only('destroy');
    }

    public function store(StoreDiscussionRequest $request)
    {
        $this->discussionService->storeDiscussion($request->validated());
        notify()->preset('success', ['message' => 'تم اضافة السؤال بنجاح']);
        return back();

    }

    public function destroy(Request $request)
    {
        $isDeleted = $this->discussionService->destroyDiscussion($request);

        if ($isDeleted) {
            notify()->preset('success', ['message' => 'تم حذف السؤال بنجاح']);
            return back();
        }

        return back()->withErrors('السؤال غير موجود.');
    }
}
