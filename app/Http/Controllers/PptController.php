<?php

namespace App\Http\Controllers;

use App\Models\Ppt;
use App\Models\Course;
use App\Models\SubTopic;
use App\Models\LinkExternal;
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
    public function create(Request $request)
    {
        $subTopics = SubTopic::all();
        return view('ppt.create', compact('subTopics'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'drive_url' => 'required|string|max:255',
            'sub_topic_id' => 'required|integer',
            'status' => 'required|string|max:255',
        ]);
        // Simpan data ppt
        Ppt::create($data);
        return redirect()->route('ppt.index')->with('status', 'Berhasil Tambah');
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
