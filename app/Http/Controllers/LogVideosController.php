<?php

namespace App\Http\Controllers;

use App\Models\LogVideo;
use Illuminate\Http\Request;


class LogVideosController extends Controller
{
    public function index()
    {
        $logVideos = LogVideo::logVideos();
        return view('logVideos.index', compact('logVideos'));
    }
    //get log (status, desc)
    public function getStatusAndDesc($user_id, $video_id)
    {
        return LogVideo::getStatusAndDesc($user_id, $video_id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'status' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_id' => 'required|exists:videos,id', 
        ]);
        LogVideo::insertLogVideo([
            'status' => $data['status'],
            'description' => $data['description'],
            'user_id' => auth()->id(), 
            'video_id' => $data['video_id'],
        ]);
        return redirect()->route('course.index')->with('status', 'Log entry updated and new log added.');
    }
    public function getLogVideo(Request $request)
    {
        $id = $request->input('id');
        $log_video = LogVideo::getLogVideo($id); 
        return response()->json([
            'status' => 'ok',
            'msg' => view('log_video.formlog', compact('log_video'))->render()
        ], 200);
    }
    public function checkButton($id)
    {
        
        $logPpt = LogVideo::where('description', 'like', '%-ppt')
            ->where('video_id', $id)
            ->orderBy('created_at', 'desc')
            ->select('status', 'description')
            ->first();

        $logVideo = LogVideo::where('description', 'like', '%-video')
            ->where('video_id', $id)
            ->orderBy('created_at', 'desc')
            ->select('status', 'description')
            ->first();

        $logEditing = LogVideo::where('description', 'like', '%-editing')
            ->where('video_id', $id) 
            ->orderBy('created_at', 'desc')
            ->select('status', 'description')
            ->first();

        if (!$logEditing) {
            $logEditing = (object) ['status' => null, 'description' => ''];  
        }

        return response()->json([
            'video' => $logVideo,
            'ppt' => $logPpt,
            'editing' => $logEditing, 
        ]);
    }
}
