<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;

class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::getAllDosens();
        return view('dosens.index', compact('dosens'));
    }

    public function show($id)
    {
        $dosen = Dosen::getDosenById($id);
        return view('dosens.show', compact('dosen'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:45',
            'no_tlpn' => 'nullable|string|max:45',
            'description' => 'nullable|string|max:45'
        ]);

        Dosen::createDosen($data);

        return redirect()->route('dosens.index');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:45',
            'no_tlpn' => 'nullable|string|max:45',
            'description' => 'nullable|string|max:45'
        ]);

        Dosen::updateDosen($id, $data);

        return redirect()->route('dosens.index');
    }

    public function destroy($id)
    {
        Dosen::deleteDosen($id);

        return redirect()->route('dosens.index');
    }
}
