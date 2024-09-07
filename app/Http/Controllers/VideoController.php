<?php

namespace App\Http\Controllers;

use App\Models\Ppt;
use App\Models\Video;
use Illuminate\Http\Request;

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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getVideoEditForm(){
        
    }
}
