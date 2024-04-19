<?php

namespace App\Http\Controllers;

use App\Jobs\doSomethingJob;
use App\Models\Video;
use App\Notifications\VideoDeleted;
use App\Repositories\VideoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $videoRepository;

    public function __construct(VideoRepository $videoRepository)
    {
        $this->videoRepository = $videoRepository;
    }
    public function index()
    {
        //
        if (isset($_GET['q']))
            $videos = Video::query()->where('title','Like','%'.$_GET['q'].'%')
                     ->orWhere('description','Like','%'.$_GET['q'].'%')
                    ->with('user')->paginate(2);
        else
           $videos = Video::with('user')->paginate(2);
        return view('videos.index',compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
     $request->validate([
        'title'=>'required|min:3|unique:videos,title|max:100',
        'description'=>'required|min:5|max:500'
     ]) ;
     $video = Video::query()->create([
        'user_id'=>Auth::user()->id,
        'title'=>$request->title,
        'description'=>$request->description
     ]);
     $file = $request->file('videoFile');
        Storage::disk('public')->put($video->id . '.mp4', file_get_contents($file));
       return redirect()->route('videos.index');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
     $video = $this->videoRepository->getVideo($id);

       return view('videos.show',compact('video'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        //

        return view('videos.edit',compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        Cache::forget('video_'.$id);
        doSomethingJob::dispatch()->delay(now()->addMinute(10));
        $video = Video::find($id);
        $video->title = $request->title;
        $video->description = $request->description;
        $video->user_id = Auth::user()->id;
        $video->save();
        return redirect()->route('videos.index');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        //
        $user = $video->user;
        $video->delete();
        $user->notify(new VideoDeleted());
        return redirect()->route('videos.index');


    }
}
