<?php

namespace App\Http\Controllers;

use App\Models\Ppt;
use App\Models\Course;
use App\Models\SubTopic;
use App\Models\LinkExternal;
use App\Models\Video;
use Illuminate\Http\Request;

class PptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = LinkExternal::getLinkOrderedByStatusActive();
        $courses = Course::with(['user', 'dosens'])->get();
        return view('course.index', compact('courses', 'links'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(String $id)
    {
        $subTopic = SubTopic::findSubTopicById($id);
        return view('ppt.create', compact('subTopic'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate data for PPT
        $datappt = $request->validate([
            'user_id' => 'required|integer',
            'name_ppt' => 'required|string|max:255',
            'sub_topic_id' => 'required|integer',
            'status_ppt' => 'required|string|max:255',
        ]);

        // Create PPT record
        $ppt = Ppt::create([
            'user_id' => $datappt['user_id'],
            'name' => $datappt['name_ppt'],
            'sub_topic_id' => $datappt['sub_topic_id'],
            'status' => $datappt['status_ppt'],
        ]);

        // Validate data for Video
        $datavideo = $request->validate([
            'name_video' => 'required|string|max:255',
            'status_video' => 'required|string|max:255',
        ]);

        // Create Video record
        Video::create([
            'name' => $datavideo['name_video'],
            'ppt_id' => $ppt->id,
            'status' => $datavideo['status_video'],
        ]);

        return redirect()->route('subTopic.show', $datappt['sub_topic_id'])->with('status', 'Berhasil Tambah');
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
}
