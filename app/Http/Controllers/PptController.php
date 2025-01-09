<?php

namespace App\Http\Controllers;

use App\Models\Ppt;
use App\Models\Video;
use App\Models\Course;
use App\Models\LogPpt;
use App\Models\SubTopic;
use App\Models\LinkExternal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        ]);

        // Create PPT record
        $ppt = Ppt::create([
            'user_id' => $datappt['user_id'],
            'name' => $datappt['name_ppt'],
            'sub_topic_id' => $datappt['sub_topic_id'],
        ]);

        // Validate data for Video
        $datavideo = $request->validate([
            'name_video' => 'required|string|max:255',
        ]);

        // Create Video record
        Video::create([
            'name' => $datavideo['name_video'],
            'ppt_id' => $ppt->id,
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
    public function update(Request $request, Ppt $ppt)
    {
        $data = $request->validate([
            'name' => 'nullable|string',
            'status' => 'nullable|in:Not Yet,Progress,Finished,Cancel',

        ]);

        // Debugging line: Remove or comment out this line in production
        // dd($data);

        $ppt->update($data);

        return redirect()->route('subTopic.show', $ppt->sub_topic_id)
            ->with('status', 'PPT updated successfully');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getPptEditForm(Request $request)
    {
        $ppt = Ppt::findOrFail($request->id);
        return response()->json([
            'status' => 'ok',
            'msg' => view('ppt.edit', compact('ppt'))->render()
        ], 200);
    }

    public function catatRecording(Ppt $ppt, $action)
    {
        //dd($video, $action);
        // Catat aksi ke dalam database melalui model

        Ppt::catatTanggalRecording(Auth::user()->id, $ppt->id, $action);

        $newppt = Ppt::findOrFail($ppt->id);

        // Response JSON untuk AJAX
        return response()->json([
            'status' => 'success',
            'message' => 'Action recorded successfully',
            'status' => $newppt->status,
            'progress' => $newppt->progress,
        ]);
    }


    public function checkButton($id)
    {
        $logPpt = LogPpt::where('ppt_id', $id)
            ->orderBy('created_at', 'desc')
            ->select('status', 'description')
            ->first();

        return response()->json([
            'ppt' => $logPpt,
        ]);
    }
}
