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
    public function show(String $id)
    {
        $videos = Video::getVideosBySubTopicId($id);
        $ppts = Ppt::getPptsBySubTopicId($id);
        $subTopic = SubTopic::findSubTopicById($id);
        return view('subTopic.detail', compact('videos', 'ppts', 'subTopic'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'topic_id' => 'required|exists:topics,id',
            'status' => 'nullable|string|in:Not Yet,Progres,Finish,Cancel',
        ]);

        $subTopic = SubTopic::create($validatedData);

        $course_id = $subTopic->topic->course_id;
        return redirect()->route('course.show', [$course_id])
            ->with('success', 'SubTopic created successfully');
    }

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
   
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $subTopic = SubTopic::findOrFail($id);
        $subTopic->update($validatedData);
        $course_id = $subTopic->topic->course_id;
        return redirect()->route('course.show', [$course_id])
            ->with('status', 'SubTopic updated successfully');
    }

    public function destroy(SubTopic $subTopic)
    {
        try {
            $course_id = $subTopic->topic->course_id;
            $subTopic->delete();
            return redirect()->route('course.show', [$course_id])
                ->with('status', 'SubTopic deleted successfully');
        } catch (\PDOException $ex) {

            $course_id = $subTopic->topic->course_id;
            $msg = "Failed to soft delete sub-topic. Please make sure there are no related records before deleting.";
            return redirect()->route('course.show', [$course_id])
                ->with(compact('course', 'topics', 'subTopics'))->with('status', $msg);
        }
    }
}
