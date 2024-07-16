<?php

namespace App\Http\Controllers;

use App\Models\Ppt;
use Illuminate\Http\Request;

class PptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ppt = Ppt::all();
        return view('ppt.index', compact('ppt'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Simpan data ppt
        Ppt::create($request);

        return redirect()->route('ppt.index')->with('status', 'Berhasil Tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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