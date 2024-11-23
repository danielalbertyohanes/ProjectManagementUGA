<?php

namespace App\Http\Controllers;

use App\Models\Ppt;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $video = Video::all();
        return view('video.index', compact('video'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        $ppts = Ppt::getPptsBySubTopicId($id);
        $subTopicId = $id; // Pass the subtopic ID to the view
        return view('video.create', compact('ppts', 'subTopicId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string',
            'detail_location' => 'required|string|max:255',
            'status_video' => 'required|string',
            'ppt_id' => 'required|integer',  // Ensure that the selected PPT exists
            'sub_topic_id' => 'required|integer',  // Ensure that the sub_topic_id is valid
        ]);

        // Simpan data video
        Video::create($data);

        return redirect()->route('subTopic.show', $data['sub_topic_id'])->with('status', 'Successfully added');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
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


    /**
     * Remove the specified resource from storage.
     */
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
        //dd($video, $action);
        // Catat aksi ke dalam database melalui model
        Video::catatTanggalRecording(Auth::user()->id, $video->id, $action);

        $newvideo = Video::findOrFail($video->id);

        // Response JSON untuk AJAX
        return response()->json([
            'status' => 'success',
            'message' => 'Action recorded successfully',
            'status' => $newvideo->status,
            'progress' => $newvideo->progress,
        ]);
    }
    public function checkFinishStatus($id)
    {
        $video = Video::find($id);

        if (!$video) {
            return response()->json(['error' => 'Video not found'], 404);
        }

        // Proper status checks
        $isVideoFinished = !is_null($video->finish_click_video);
        $isPptFinished = !is_null($video->finish_click_ppt);
        $isEditingFinished = !is_null($video->finish_click_editing);

        $isVideoStart = !is_null($video->started_at_video);
        $isPptStart = !is_null($video->started_at_ppt);
        $isEditingStart = !is_null($video->started_at_editing);

        $isVideoPause = !is_null($video->pause_click_video);
        $isPptPause = !is_null($video->pause_click_ppt);
        $isEditingPause = !is_null($video->pause_click_editing);

        return response()->json([
            'video' => [
                'started' => $isVideoStart,
                'paused' => $isVideoPause,
                'finished' => $isVideoFinished,
            ],
            'ppt' => [
                'started' => $isPptStart,
                'paused' => $isPptPause,
                'finished' => $isPptFinished,
            ],
            'editing' => [
                'started' => $isEditingStart,
                'paused' => $isEditingPause,
                'finished' => $isEditingFinished,
            ],
        ]);
    }
}
