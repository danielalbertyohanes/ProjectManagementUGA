<?php

namespace App\Http\Controllers;

use App\Models\SubTopic;
use App\Models\Topic;
use Illuminate\Http\Request;

class SubTopicController extends Controller
{
    // Get all sub-topics
    public function index()
    {
        $subTopics = SubTopic::all();
        dd($subTopics);
        return view('subTopic.index', compact('subTopics'));
    }

    // Get sub-topics by topic_id
    public function getSubTopicByTopicId($topic_id)
    {
        $subTopics = SubTopic::getSubTopicsByTopicId($topic_id);
        return view('subTopic.index', compact('subTopics'));
    }

    // Store a new sub-topic
    public function store(Request $request)
    {
        //dd($request);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'topic_id' => 'required|exists:topics,id',
            'status' => 'nullable|string|in:Not Yet,Progres,Finish,Cancel',

        ]);
        //dd($validatedData);
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

    // Update sub-topic
    public function update(Request $request, SubTopic $subTopic)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:Not Yet,Progres,Finish,Cancel',
        ]);

        $subTopic->update($validatedData);

        return redirect()->route('subTopic.index')
            ->with('success', 'SubTopic updated successfully');
    }
    public function edit(String $id)
    {
        $subTopic = SubTopic::findOrFail($id);
        return view('subTopic.edit', compact('subTopic'));
    }

    // Soft delete sub-topic
    public function destroy(SubTopic $subTopic)
    {
        try {
            $subTopic->delete();
            return redirect()->route('course.index')->with('status', 'SubTopic soft deleted successfully');
        } catch (\PDOException $ex) {
            $msg = "Failed to soft delete sub-topic. Please make sure there are no related records before deleting.";
            return redirect()->route('course.index')->with('status', $msg);
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
