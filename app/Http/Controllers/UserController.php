<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< Updated upstream
use App\Models\User;
=======
use Illuminate\Support\Facades\Log;
>>>>>>> Stashed changes

class UserController extends Controller
{
    public function index()
    {
        // Mengambil data karyawan dari model
        $users = User::getEmployee(); // Ganti $user dengan $users
        return view('employee.index', compact('users')); // Menggunakan compact('users')
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'npk' => 'nullable|string|max:45',
            'email' => 'nullable|string|email|max:255',
            'no_telp' => 'nullable|string|max:45',
            'position_id' => 'nullable|integer',
        ]);

        $user->update($data);

        return redirect()->route('dosen.index')->with('status', 'Dosen updated successfully');
    }


    public function show(string $id)
    {
        $user = User::findOrFail($id);
<<<<<<< Updated upstream
        return view('employee.show', compact('user'));
=======
        return view('user.index', compact('user'));
    }

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $user = User::findOrFail($id);
        $positions = Position::getAll();
        return response()->json([
            'status' => 'ok',
            'msg' => view('employee.edit', compact('user', 'positions'))->render()
        ], 200);
    }

    public function create()
    {
        $positions = Position::all();
        return view('employee.create', compact('positions'));
    }

    public function getCreateForm(Request $request) {
        $positions = Position::getAll();
        //Log::info('Masuk ke getCreateForm'); // Cek apakah masuk ke method ini
        return response()->json(['status' => 'ok', 'msg' => view('employee.create', compact('positions'))->render()]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'npk' =>  ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'no_telp' =>  ['required'],
            'password' => ['required'],
            'position_id' =>  ['required']
        ]);

        User::create($data);

        return redirect()->route('employee.index')->with('status', 'Employee berhasil ditambahkan');
>>>>>>> Stashed changes
    }
}
