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

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:45',
            'npk' => 'nullable|string|max:45',
            'fakultas' => 'nullable|string|max:255',
            'no_telp' => 'nullable|string|max:45',
            'description' => 'nullable|string|max:45'
        ]);
        Dosen::create($data);
        return redirect()->route('dosen.index')->with('status', 'Dosen berhasil ditambahkan');
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
            'no_telp' => 'nullable|string|max:45',
            'description' => 'nullable|string|max:45'
        ]);
        $dosen->update($data);
        return redirect()->route('dosen.index')->with('status', 'Dosen berhasil diperbarui');
    }

    public function destroy(Dosen $dosen)
    {
        try {
            $deletedData = $dosen;
            $deletedData->delete();
            return redirect()->route('dosen.index')->with('status', 'Hore! Data berhasil dihapus');
        } catch (\PDOException $ex) {

            $msg = "Gagal menghapus data! Pastikan tidak ada data terkait sebelum menghapusnya";
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
