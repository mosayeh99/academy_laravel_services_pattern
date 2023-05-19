<?php

namespace App\Http\Controllers;

use App\Http\Requests\Letter\StoreLetterRequest;
use App\Services\LetterService;
use Illuminate\Http\Request;

class LetterController extends Controller
{
    private LetterService $letterService;

    public function __construct(LetterService $letterService)
    {
        $this->letterService = $letterService;
        $this->middleware('TeacherNotAllowed');
        $this->middleware('StudentNotAllowed')->only(['acceptRequest', 'refuseRequest']);
        $this->middleware(['permission:apply letters,student'])->only('store');
    }

    public function store(StoreLetterRequest $request)
    {
        $this->letterService->storeLetter($request);
        notify()->preset('success', ['message' => 'تم تقديم الطلب بنجاح']);
        return back();
    }

    public function acceptRequest(Request $request)
    {
        $isUpdated = $this->letterService->acceptLetter($request);

        if ($isUpdated) {
            notify()->preset('success', ['message' => 'تم قبول الطلب بنجاح']);
            return back();
        }

        return back()->withErrors('الطلب غير موجود.');
    }

    public function refuseRequest(Request $request)
    {
        $isUpdated = $this->letterService->refuseLetter($request);

        if ($isUpdated) {
            notify()->preset('success', ['message' => 'تم رفض الطلب']);
            return back();
        }

        return back()->withErrors('الطلب غير موجود.');
    }

    public function destroy(Request $request)
    {
        $isDeleted = $this->letterService->destroyLetter($request);

        if ($isDeleted) {
            notify()->preset('success', ['message' => 'تم حذف الطلب بنجاح']);
            return back();
        }

        return back()->withErrors('الطلب غير موجود.');
    }
}
