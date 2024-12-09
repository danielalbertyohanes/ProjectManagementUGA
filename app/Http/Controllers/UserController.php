<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // Mengambil data karyawan dari model
        $users = User::getAll(); // Ganti $user dengan $users
        return view('employee.index', compact('users')); // Menggunakan compact('users')

    }

    public function update(Request $request, string $id)
    {
        // Validate incoming request data
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'npk' => 'nullable|string|max:45',
            'email' => 'nullable|string|email|max:255',
            'password' => 'nullable|string|min:6', // Ensure passwords have a minimum length
            'no_telp' => 'nullable|string|max:45',
            'position_id' => 'nullable|integer|exists:positions,id', // Ensure position_id exists in the positions table
        ]);

        // Find user by ID or fail if not found
        $user = User::findOrFail($id);

        // // Handle password separately if it's present
        // if (!empty($data['password'])) {
        //     $data['password'] = bcrypt($data['password']); // Hash the password before saving
        // }

        // Update user data
        $user->update($data);

        // Redirect with success message
        return redirect()->route('employee.index')->with('status', 'User updated successfully');
    }
    public function changePassword(Request $request, string $id)
    {
        // Validasi input
        $data = $request->validate([
            'current_password' => 'required|string|min:6', // Password saat ini
            'new_password' => 'required|string|min:6|confirmed', // Password baru (dengan konfirmasi)
        ]);

        // Temukan user berdasarkan ID
        $user = User::findOrFail($id);

        // Periksa apakah password saat ini cocok
        if (!\Hash::check($data['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update password user
        $user->update([
            'password' => bcrypt($data['new_password']),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('employee.show', $id)->with('status', 'Password updated successfully');
    }

    public function show(string $id)
    {

        $user = User::findOrFail($id);
        return view('employee.show', compact('user'));
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
}
