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
        ]);

        $logVideo = LogVideo::insertLog($data);

        return redirect()->route('logVideos.index')->with('status', 'Berhasil Tambah');
    }
    //update
    public function update($user_id, $video_id, Request $request)
    {
        $data = $request->validate([
            'status' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $logVideo = LogVideo::updateLog($user_id, $video_id, $data);

        return redirect()->route('logVideos.index')->with('status', 'Berhasil Update');
    }
}
