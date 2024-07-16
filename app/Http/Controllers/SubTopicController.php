<?php

namespace App\Http\Controllers;

use App\Models\SubTopic;
use Illuminate\Http\Request;

class SubTopicController extends Controller
{
    // Get all topics
    public function index()
    {
        $topics = SubTopic::getAllTopics();
        return view('subTopics.index', compact('subTopics'));
    }
    // Get topics by course_id
    public function getTopicByCourseId($topic_id)
    {
        $topics = SubTopic::getTopicsByCourseId($topic_id);
        return view('subTopics.index', compact('subTopics'));
    }
    //insert 
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'progres' => 'nullable|string|in:active,inactive,pending',
            'status' => 'nullable|integer|min:0|max:100',
        ]);
        $subTopic = SubTopic::insertSubTopics($validatedData);
        return redirect()->route('subTopics.index')
            ->with('success', 'SubTopic created successfully');
    }
    //update
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'progres' => 'nullable|string|in:active,inactive,pending',
            'status' => 'nullable|integer|min:0|max:100',
        ]);
        $subTopic = SubTopic::insertSubTopics($validatedData);
        if ($subTopic) {
            return redirect()->route('subTopics.index')
                ->with('success', 'SubTopic updated successfully');
        } else {
            return back()->withInput()->with('error', 'SubTopic not found or update failed');
        }
    }
    // Soft delete subtopic
    public function softDelete(SubTopic $subTopic)
    {
        try {
            $subTopic->delete(); // Soft delete
            return redirect()->route('subTopics.index')->with('status', 'SubTopic soft deleted successfully');
        } catch (\PDOException $ex) {
            $msg = "Failed to soft delete subtopic. Please make sure there are no related records before deleting.";
            return redirect()->route('subTopics.index')->with('status', $msg);
        }
    }
    // Force delete subtopic
    public function forceDelete($id)
    {
        try {
            $topic = SubTopic::withTrashed()->findOrFail($id);
            $topic->forceDelete(); // Permanent delete
            return redirect()->route('subTopics.index')->with('status', 'subTopic permanently deleted');
        } catch (\PDOException $ex) {
            $msg = "Failed to permanently delete topic.";
            return redirect()->route('subTopics.index')->with('status', $msg);
        }
    }
}
