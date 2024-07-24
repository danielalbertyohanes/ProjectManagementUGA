<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::getAllDosens();
        return view('dosen.index', compact('dosens'));
    }

    // public function show($id)
    // {
    //     $dosen = Dosen::getDosenById($id);
    //     return view('dosen.show', compact('dosen'));
    // }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:45',
            'npk' => 'nullable|string|max:45',
            'fakultas' => 'nullable|string|max:255',
            'no_tlpn' => 'nullable|string|max:45',
            'description' => 'nullable|string|max:45'
        ]);

        Dosen::create($data);

        return redirect()->route('dosen.index');
    }

    public function create()
    {

        return view("dosen.create");
    }

    public function getCreateForm(Request $request)
    {
        return response()->json(['status' => 'ok', 'msg' => view('dosen.create')->render()]);
    }

    public function update(Request $request, Dosen $dosen)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:45',
            'npk' => 'nullable|string|max:45',
            'fakultas' => 'nullable|string|max:255',
            'no_tlpn' => 'nullable|string|max:45',
            'description' => 'nullable|string|max:45'
        ]);

        $dosen->update($data);

        return redirect()->route('dosen.index')->with('status', 'dosen updated successfully');
    }

    public function destroy(Dosen $dosen)
    {
        try {
            $deletedData = $dosen;
            $deletedData->delete();
            return redirect()->route('dosen.index')->with('status', 'Horray ! Your data is successfully deleted !');
        } catch (\PDOException $ex) {

            $msg = "Failed to delete data ! Make sure there is no related data before deleting it";
            return redirect()->route('dosen.index')->with('status', $msg);
        }
    }

    public function getEditForm(Request $request)
    {
        $dosen = Dosen::findOrFail($request->id);
        return response()->json([
            'status' => 'ok',
            'msg' => view('dosen.edit', compact('dosen'))->render()
        ], 200);
    }
}
