<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    // Get all topics
    public function index()
    {
        $topics = Topic::getAllTopics();
        return view('topics.index', compact('topics'));
    }

    // Get topics by course_id
    public function getTopicByCourseId($course_id)
    {
        $topics = Topic::getTopicsByCourseId($course_id);
        return view('topics.index', compact('topics'));
    }
    //insert 
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'status' => 'nullable|string|in:active,inactive,pending',
            'progres' => 'nullable|integer|min:0|max:100',
        ]);
        $topic = Topic::insertTopics($validatedData);
        return redirect()->route('topics.index')
            ->with('success', 'Topic created successfully');
    }
    //update
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'status' => 'nullable|string|in:active,inactive,pending',
            'progres' => 'nullable|integer|min:0|max:100',
        ]);

        $topic = Topic::updateTopic($id, $validatedData); // Memanggil updateTopic dengan $id

        if ($topic) {
            return redirect()->route('topics.index')
                ->with('success', 'Topic updated successfully');
        } else {
            return back()->withInput()->with('error', 'Topic not found or update failed');
        }
    }
    // Soft delete topic
    public function softDelete(Topic $topic)
    {
        try {
            $topic->delete(); // Soft delete
            return redirect()->route('topics.index')->with('status', 'Topic soft deleted successfully');
        } catch (\PDOException $ex) {
            $msg = "Failed to soft delete topic. Please make sure there are no related records before deleting.";
            return redirect()->route('topics.index')->with('status', $msg);
        }
    }

    // Force delete topic
    public function forceDelete($id)
    {
        try {
            $topic = Topic::withTrashed()->findOrFail($id);
            $topic->forceDelete(); // Permanent delete
            return redirect()->route('topics.index')->with('status', 'Topic permanently deleted');
        } catch (\PDOException $ex) {
            $msg = "Failed to permanently delete topic.";
            return redirect()->route('topics.index')->with('status', $msg);
        }
    }
}
