<?php

namespace App\Http\Controllers;

use App\Models\Ppt;
use App\Models\Video;
use App\Models\LogVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    public function index()
    {
        $video = Video::all();
        return view('video.index', compact('video'));
    }

    public function create(string $id)
    {
        $ppts = Ppt::getPptsBySubTopicId($id);
        $subTopicId = $id; // Pass the subtopic ID to the view
        return view('video.create', compact('ppts', 'subTopicId'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'detail_location' => 'required|string|max:255',
            'status_video' => 'required|string',
            'ppt_id' => 'required|integer',
            'sub_topic_id' => 'required|integer',
        ]);
        Video::create($data);
        return redirect()->route('subTopic.show', $data['sub_topic_id'])->with('status', 'Successfully added');
    }
    public function update(Request $request, Video $video)
    {
        $data = $request->validate([
            'name' => 'nullable|string',
            'location' => 'nullable|in:UBAYA,Not UBAYA',
            'detail_location' => 'nullable|string',
            'status' => 'nullable|in:Not Yet,Recording,Recorded,PPT Recording,PPT Recorded,Editing,Edited,Pause Recording',
        ]);
        $video->update($data);
        return redirect()->route('subTopic.show', $video->ppt->sub_topic_id)
            ->with('status', 'Video updated successfully');
    }
    public function destroy(string $id)
    {
        //
    }
    public function getVideoEditForm(Request $request)
    {
        $video = Video::findOrFail($request->id);
        return response()->json([
            'status' => 'ok',
            'msg' => view('video.edit', compact('video'))->render()
        ], 200);
    }
    public function catatRecording(Video $video, $action)
    {
        Video::catatTanggalRecording(Auth::user()->id, $video->id, $action);
        $newvideo = Video::findOrFail($video->id);
        return response()->json([
            'status' => 'success',
            'message' => 'Action recorded successfully',
            'status' => $newvideo->status,
            'progress' => $newvideo->progress,
        ]);
    }
}
