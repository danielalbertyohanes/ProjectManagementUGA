<?php

namespace App\Http\Controllers;

use App\Models\Ppt;
use App\Models\SubTopic;
use App\Models\Topic;
use App\Models\Video;
use App\Models\Course;
use Illuminate\Http\Request;

class SubTopicController extends Controller
{
    // Get all sub-topics
    public function index()
    {
        $subTopics = SubTopic::all();
        return view('subTopic.index', compact('subTopics'));
    }

    public function show(String $id)
    {
        $videos = Video::getVideosBySubTopicId($id);
        $ppts = Ppt::getPptsBySubTopicId($id);
        $subTopic = SubTopic::findSubTopicById($id);
        return view('subTopic.detail', compact('videos', 'ppts', 'subTopic'));
    }

    // Get sub-topics by topic_id
    public function getSubTopicByTopicId($topic_id)
    {
        $subTopics = SubTopic::where('topic_id', $topic_id)->get();
        return view('subTopic.index', compact('subTopics'));
    }

    // Store a new sub-topic
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'topic_id' => 'required|exists:topics,id',
            'status' => 'nullable|string|in:Not Yet,Progres,Finish,Cancel',
        ]);

        SubTopic::create($validatedData);

        return redirect()->route('course.index')
            ->with('success', 'SubTopic created successfully');
    }

    // Show create form
    public function create()
    {
        $topics = Topic::all();
        return view('subTopic.create', compact('topics'));
    }

    public function edit($id)
    {
        $subTopic = SubTopic::findOrFail($id);
        $topics = Topic::all();
        return view('subTopic.edit', compact('subTopic', 'topics'));
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;

        $subTopic = SubTopic::findOrFail($id);
        return response()->json([
            'status' => 'ok',
            'msg' => view('subTopic.edit', compact('subTopic'))->render()
        ], 200);
    }
    // Update sub-topic
    public function update(Request $request, $id)
    {
        // Validasi data yang diinput
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'nullable|string|in:Not Yet,Progres,Finish,Cancel',
            'progress' => 'nullable|integer|min:0|max:100',
        ]);

        // Cari subTopic berdasarkan id
        $subTopic = SubTopic::findOrFail($id);

        // Update subTopic dengan data yang sudah tervalidasi
        $subTopic->update($validatedData);

        $course_id = $subTopic->topic->course_id;
        $course = Course::findOrFail($course_id); // Ensure this is correct
        $topics = Topic::getTopicsByCourseId($course_id); // Assuming the relationship is set up
        $subTopics = SubTopic::getSubTopicsByCourseId($course_id);


        // Redirect ke halaman course.detail dengan data yang diperlukan dan pesan sukses
        return redirect()->route('course.show', [$course_id])
            ->with(compact('course', 'topics', 'subTopics'))
            ->with('status', 'SubTopic updated successfully');
    }


    // Soft delete sub-topic
    public function softDelete(SubTopic $subTopic)
    {
        try {
            $subTopic->delete();
            return redirect()->route('subTopic.index')->with('status', 'SubTopic soft deleted successfully');
        } catch (\PDOException $ex) {
            $msg = "Failed to soft delete sub-topic. Please make sure there are no related records before deleting.";
            return redirect()->route('subTopic.index')->with('status', $msg);
        }
    }

    // Force delete sub-topic
    public function forceDelete($id)
    {
        try {
            $subTopic = SubTopic::withTrashed()->findOrFail($id);
            $subTopic->forceDelete();
            return redirect()->route('subTopic.index')->with('status', 'SubTopic permanently deleted');
        } catch (\PDOException $ex) {
            $msg = "Failed to permanently delete sub-topic.";
            return redirect()->route('subTopic.index')->with('status', $msg);
        }
    }
}
