<?php

namespace App\Http\Controllers;

use App\Models\LinkExternal;
use Illuminate\Http\Request;

class LinkExternalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $links = LinkExternal::getLinkOrderedByStatus();
        return view('link_external.index', compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('link_external.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string',
            'value' => 'nullable|string',
            'status' => 'nullable|string'
        ]);

        LinkExternal::create($data);

        return redirect()->route('link_external.index');
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
    public function update(Request $request, $id)
    {
        $link = LinkExternal::find($id);
        $data = $request->validate([
            'name' => 'nullable|string',
            'value' => 'nullable|string',
            'status' => 'nullable|string|in:not active,active',
        ]);
        $link->update($data);
        return redirect()->route('link_external.index')->with('status', 'Link updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $link = LinkExternal::findOrFail($id);


        return response()->json([
            'status' => 'ok',
            'msg' => view('link_external.edit', compact('link'))->render()
        ], 200);
    }
}
