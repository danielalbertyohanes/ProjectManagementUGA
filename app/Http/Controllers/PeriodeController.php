<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periodes = Periode::getAllPeriode();
        return view('periode.index', compact('periodes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:45',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'kurasi_date' => 'required|date',
            'status' => 'required|in:Not Active,Active'
        ]);

        Periode::create($data);

        return redirect()->route('periode.index')->with('success', 'Periode created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Periode $periode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Periode $periode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Periode $periode)
    {
        $data = $request->validate([
            'name' => 'required|string|max:45',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'kurasi_date' => 'required|date',
            'status' => 'required|in:Not Active,Active'
        ]);
        $periode->update($data);

        return redirect()->route('periode.index')->with('status', 'Periode updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Periode $periode)
    {
        //
    }


    public function getCreateForm()
    {

        return response()->json([
            'status' => 'ok',
            'msg' => view('periode.create')->render()
        ], 200);
    }

    public function getEditForm(Request $request)
    {
        $periode = Periode::findOrFail($request->id);
        return response()->json([
            'status' => 'ok',
            'msg' => view('periode.edit', compact('periode'))->render()
        ], 200);
    }
}
