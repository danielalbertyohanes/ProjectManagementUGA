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
        // Validate the incoming request data
        $data = $request->validate([
            'status' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_id' => 'required|exists:videos,id', // Ensure video_id is valid
        ]);

        /* // Update the status of the log video
        LogVideo::where('video_id', $request->video_id)
            ->where('user_id', auth()->id()) // Assumes the log is for the currently authenticated user
            ->update(['status' => $data['status']]); */

        // Insert a new log entry with description
        LogVideo::insertLogVideo([
            'status' => $data['status'],
            'description' => $data['description'],
            'user_id' => auth()->id(), // Assuming the user is authenticated
            'video_id' => $data['video_id'],
        ]);

        //return redirect()->route('subTopic.show', $data['sub_topic_id'])->with('status', 'Successfully added');
        // Optionally, return a response or redirect
        return redirect()->route('course.index')->with('status', 'Log entry updated and new log added.');
    }
    public function getLogVideo(Request $request)
    {
        $id = $request->input('id');

        // Mengambil banyak log_video berdasarkan video_id
        $log_video = LogVideo::getLogVideo($id); // Mengambil banyak data log_video

        // Debugging untuk memastikan data diterima dengan benar
        //dd($id, $log_video);

        return response()->json([
            'status' => 'ok',
            'msg' => view('log_video.formlog', compact('log_video'))->render()
        ], 200);
    }
}
