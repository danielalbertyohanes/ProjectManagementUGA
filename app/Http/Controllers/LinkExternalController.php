<?php

namespace App\Http\Controllers;

use App\Models\LinkExternal;
use Illuminate\Http\Request;

class LinkExternalController extends Controller
{
    public function index()
    {
        $links = LinkExternal::getLinkOrderedByStatus();
        return view('link_external.index', compact('links'));
    }

    public function create()
    {
        return view('link_external.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string',
            'url' => 'nullable|string',
            'status' => 'nullable|string'
        ]);
        LinkExternal::create($data);
        return redirect()->route('link_external.index')->with('status', 'Link berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $link = LinkExternal::find($id);
        $data = $request->validate([
            'name' => 'nullable|string',
            'url' => 'nullable|string',
            'status' => 'nullable|string|in:not active,active',
        ]);
        $link->update($data);
        return redirect()->route('link_external.index')->with('status', 'Link berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        //
    }

    public function getCreateForm(Request $request)
    {
        return response()->json(['status' => 'ok', 'msg' => view('link_external.create')->render()]);
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
