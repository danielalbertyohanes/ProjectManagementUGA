<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Topic;
use App\Models\Course;
use App\Models\SubTopic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    // Get all topics
    public function index()
    {
        $topics = Topic::all();
        return view('topic.index', compact('topics'));
    }

    // Get topics by course_id
    public function getTopicByCourseId($course_id)
    {
        $topics = Topic::where('course_id', $course_id)->get();
        return view('topic.index', compact('topics'));
    }

    public function store(Request $request)
    {
        // Validate the topic data
        $dataTopic = $request->validate([
            'name' => 'required|string|max:255',
            'course_id' => 'required|exists:courses,id',
            'status' => 'required|in:Not Yet,Progres,Finish,Cancel',
        ]);

        // Create the topic
        $topic = Topic::create($dataTopic);

        // Validate the subtopics data
        $subTopicsData = $request->validate([
            'name_subTopic.*' => 'required|string|max:255',
            'drive_url.*' => 'required|string|max:255',
        ]);

        // Create the subtopics and associate them with the topic
        foreach ($request->name_subTopic as $index => $name_subTopic) {
            SubTopic::create([
                'name' => $name_subTopic,
                'drive_url' => $request->drive_url[$index],
                'topic_id' => $topic->id,
            ]);
        }

        return redirect()->route('course.show', $request->course_id)
            ->with('status', 'Topic and subtopics created successfully');
    }

    public function create(string $course_id)
    {
        $course = Course::findOrFail($course_id);
        return view('topic.create', compact('course'));
    }

    //update
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:Not Yet,Progres,Finish,Cancel',
            'progres' => 'nullable|integer|min:0|max:100',
            'name_subTopic.*' => 'required|string|max:255',
            'drive_url.*' => 'required|string|max:255',
        ]);

        $topic = Topic::findOrFail($id);
        $topic->update($validatedData);

        // Update subtopics
        foreach ($request->name_subTopic as $index => $name_subTopic) {
            $subTopic = SubTopic::where('topic_id', $topic->id)->skip($index)->first();
            if ($subTopic) {
                $subTopic->update([
                    'name' => $name_subTopic,
                    'drive_url' => $request->drive_url[$index],
                ]);
            } else {
                SubTopic::create([
                    'name' => $name_subTopic,
                    'drive_url' => $request->drive_url[$index],
                    'topic_id' => $topic->id,
                ]);
            }
        }

        return redirect()->route('course.show', $topic->course_id)
            ->with('status', 'Topic updated successfully');
    }


    // Soft delete topic
    public function softDelete(Topic $topic)
    {
        try {
            $topic->delete(); // Soft delete
            return redirect()->route('topic.index')->with('status', 'Topic soft deleted successfully');
        } catch (\PDOException $ex) {
            $msg = "Failed to soft delete topic. Please make sure there are no related records before deleting.";
            return redirect()->route('topic.index')->with('status', $msg);
        }
    }

    public function edit(string $id)
    {
        $topic = Topic::with('subTopics')->findOrFail($id);
        $course = $topic->course; // Asumsi ada relasi antara Topic dan Course

        return view('topic.edit', compact('topic', 'course'));
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $topic = Topic::findOrFail($id);
        return response()->json([
            'status' => 'ok',
            'msg' => view('topic.edit', compact('topic'))->render()
        ], 200);
    }


    // Force delete topic
    public function forceDelete($id)
    {
        try {
            $topic = Topic::withTrashed()->findOrFail($id);
            $topic->forceDelete(); // Permanent delete
            return redirect()->route('topic.index')->with('status', 'Topic permanently deleted');
        } catch (\PDOException $ex) {
            $msg = "Failed to permanently delete topic.";
            return redirect()->route('topic.index')->with('status', $msg);
        }
    }
}
