<?php
namespace App\Repositories;
use App\Models\Video;
use Illuminate\Support\Facades\Cache;

class VideoRepository
{
    public function getVideo($id)
    {
        $video = Cache::remember('video_' . $id, 600, function () use ($id) {
            return Video::query()->find($id);
        });
        return $video;
    }

}
