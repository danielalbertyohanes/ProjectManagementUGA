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
    public function index()
    {
        $links = LinkExternal::getLinkOrderedByStatusActive();
        $courses = Course::with(['user', 'dosens'])->get();
        return view('course.index', compact('courses', 'links'));
    }

    public function create(String $id)
    {
        $subTopic = SubTopic::findSubTopicById($id);
        return view('ppt.create', compact('subTopic'));
    }

    public function store(Request $request)
    {
        $datappt = $request->validate([
            'user_id' => 'required|integer',
            'name_ppt' => 'required|string|max:255',
            'sub_topic_id' => 'required|integer',
        ]);
        $ppt = Ppt::create([
            'user_id' => $datappt['user_id'],
            'name' => $datappt['name_ppt'],
            'sub_topic_id' => $datappt['sub_topic_id'],
        ]);
        $datavideo = $request->validate([
            'name_video' => 'required|string|max:255',
            'detail_location' => 'required|string|max:255',
        ]);
        Video::create([
            'name' => $datavideo['name_video'],
            'detail_location' => $datavideo['detail_location'],
            'ppt_id' => $ppt->id,
        ]);

        return redirect()->route('subTopic.show', $datappt['sub_topic_id'])->with('status', 'Berhasil Tambah');
    }

    public function update(Request $request, Ppt $ppt)
    {
        $data = $request->validate([
            'name' => 'nullable|string',
            'status' => 'nullable|in:Not Yet,Progress,Finished,Cancel',
        ]);
        $ppt->update($data);
        return redirect()->route('subTopic.show', $ppt->sub_topic_id)
            ->with('status', 'PPT berhasil diperbarui');
    }

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
        Ppt::catatTanggalRecording(Auth::user()->id, $ppt->id, $action);

        $newppt = Ppt::findOrFail($ppt->id);
        return response()->json([
            'status' => 'success',
            'message' => 'Aksi berhasil dicatat',
            'status' => $newppt->status,
            'progress' => $newppt->progress,
        ]);
    }
}
