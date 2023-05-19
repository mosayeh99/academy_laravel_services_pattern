<?php

namespace App\Http\Controllers;

use App\Http\Requests\Video\StoreVideoRequest;
use App\Http\Requests\Video\UpdateVideoRequest;
use App\Models\Course;
use App\Models\Video;
use App\Services\VideoService;

class VideoController extends Controller
{
    private VideoService $videoService;

    public function __construct(VideoService $videoService)
    {
        $this->videoService = $videoService;
        $this->middleware('AgencyNotAllowed');
        $this->middleware('StudentNotAllowed')->except('index');
    }

    public function index(Course $course, Video $video = null)
    {
        $data = $this->videoService->getVideo($course, $video);
        return view('course_videos', $data);
    }

    public function store(StoreVideoRequest $request)
    {
        $this->videoService->storeVideo($request);
        notify()->preset('success', ['message' => 'تمت اضافة الدرس بنجاح']);
        return back();
    }

    public function update(UpdateVideoRequest $request, Video $video)
    {
        $this->videoService->updateVideo($request, $video);
        notify()->preset('success', ['message' => 'تم تعديل الدرس بنجاح']);
        return back();
    }

    public function destroy(Video $video)
    {
        $this->videoService->destroyVideo($video);
        notify()->preset('success', ['message' => 'تم حذف الدرس بنجاح']);
        return to_route('videos.index', $video->course_id);
    }
}
