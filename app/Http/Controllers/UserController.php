<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
}
