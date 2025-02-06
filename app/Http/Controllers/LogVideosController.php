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
    public function getStatusAndDesc($user_id, $video_id)
    {
        return LogVideo::getStatusAndDesc($user_id, $video_id);
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
            ->orderBy('id', 'desc')
            ->select('status', 'description')
            ->first();
        $logVideo = LogVideo::where('description', 'like', '%-video')
            ->where('video_id', $id)
            ->orderBy('id', 'desc')
            ->select('status', 'description')
            ->first();
        $logEditing = LogVideo::where('description', 'like', '%-editing')
            ->where('video_id', $id)
            ->orderBy('id', 'desc')
            ->select('status', 'description')
            ->first();

        return response()->json([
            'video' => $logVideo,
            'ppt' => $logPpt,
            'editing' => $logEditing,
        ]);
    }
}
