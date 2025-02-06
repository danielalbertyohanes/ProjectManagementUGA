<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Topic;
use App\Models\Course;
use App\Models\SubTopic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function getTopicByCourseId($course_id)
    {
        $topics = Topic::where('course_id', $course_id)->get();
        return view('topic.index', compact('topics'));
    }

    public function store(Request $request)
    {
        $dataTopic = $request->validate([
            'name' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
        ]);
        $topic = Topic::create($dataTopic);
        $subTopicsData = $request->validate([
            'name_subTopic.*' => 'required|string|max:255',
        ]);
        foreach ($request->name_subTopic as $index => $name_subTopic) {
            SubTopic::create([
                'name' => $name_subTopic,
                'topic_id' => $topic->id,
            ]);
        }
        return redirect()->route('course.show', $request->course_id)
            ->with('status', 'Topik dan subtopik berhasil dibuat');
    }

    public function getCreateForm(Request $request)
    {
        $course = Course::findOrFail($request->course_id);
        return response()->json([
            'status' => 'ok',
            'msg' => view('topic.create', compact('course'))->render()
        ], 200);
    }

    // //update
    // public function update(Request $request, $id)
    // {
    //     $validatedData = $request->validate([
    //         'name' => 'required|string|max:255',
    //         'status' => 'required|in:Not Yet,Progres,Finish,Cancel',
    //         'name_subTopic.*' => 'required|string|max:255',
    //         'drive_url.*' => 'required|string|max:255',
    //     ]);

    //     $topic = Topic::findOrFail($id);
    //     $topic->update($validatedData);
    //     foreach ($request->name_subTopic as $index => $name_subTopic) {
    //         $subTopic = SubTopic::where('topic_id', $topic->id)->skip($index)->first();
    //         if ($subTopic) {
    //             $subTopic->update([
    //                 'name' => $name_subTopic,
    //             ]);
    //         } else {
    //             SubTopic::create([
    //                 'name' => $name_subTopic,
    //                 'topic_id' => $topic->id,
    //             ]);
    //         }
    //     }
    //     return redirect()->back()->with('status', 'Topik berhasil diperbarui');
    // }

    // public function destroy(Topic $topic)
    // {
    //     try {
    //         $topic->delete(); // Soft delete
    //         return redirect()->back()->with('status', 'Topik berhasil dihapus');
    //     } catch (\PDOException $ex) {
    //         $msg = "Gagal menghapus topik";
    //         return redirect()->back()->with('status', $msg);
    //     }
    // }

    // public function edit(string $id)
    // {
    //     $topic = Topic::with('subTopics')->findOrFail($id);
    //     $course = $topic->course;
    //     return view('topic.edit', compact('topic', 'course'));
    // }

    // public function getEditForm(Request $request)
    // {
    //     $id = $request->id;
    //     $topic = Topic::findOrFail($id);
    //     return response()->json([
    //         'status' => 'ok',
    //         'msg' => view('topic.edit', compact('topic'))->render()
    //     ], 200);
    // }
}
