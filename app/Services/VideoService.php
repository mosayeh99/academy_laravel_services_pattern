<?php

namespace App\Services;

use App\Models\Video;
use App\Traits\AuthorizeActions;
use Illuminate\Support\Facades\Storage;

class VideoService
{
    use AuthorizeActions;

    public function getVideo($course, $video = null)
    {
        $video = $video ?? $course->videos->first();
        $this->authorizeAction('get-video', $course, $video);
        return ['course' => $course->load('videos'), 'video' => $video];
    }

    public function storeVideo($request)
    {
        $file = $request->file('file');
        $path = $file->store("courses/$request->course_id/videos", 'public');

        Video::create([
            'name' => $request->name,
            'course_id' => $request->course_id,
            'path' => $path,
        ]);
    }

    public function updateVideo($request, $video)
    {
        $this->authorizeAction('update-video', $video);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store("courses/$request->course_id/videos", 'public');

            Storage::disk('public')->delete($video->path);

            $video->update([
                'name' => $request->name,
                'path' => $path
            ]);
        } else {
            $video->update([
                'name' => $request->name,
            ]);
        }
    }

    public function destroyVideo($video)
    {
        $this->authorizeAction('delete-video', $video);
        Storage::disk('public')->delete($video->path);
        $video->delete();
    }
}
