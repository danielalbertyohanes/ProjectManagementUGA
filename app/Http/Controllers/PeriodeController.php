<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index()
    {
        $periodes = Periode::getAllPeriode();
        return view('periode.index', compact('periodes'));
    }
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
