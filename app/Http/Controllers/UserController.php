<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Position;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::getAll();
        return view('employee.index', compact('users'));
    }

    public function update(Request $request, string $id, string $from)
    {
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'npk' => 'nullable|string|max:45',
            'email' => 'nullable|string|email|max:255',
            'password' => 'nullable|string|min:6',
            'no_telp' => 'nullable|string|max:45',
            'position_id' => 'nullable|integer|exists:positions,id',
        ]);
        $user = User::findOrFail($id);
        $user->update($data);
        if ($from === 'user') {
            return redirect()->route('user.profile', $id)->with('status', 'Data berhasil diperbarui');
        } else {
            return redirect()->route('employee.index')->with('status', 'Pengguna berhasil diperbarui');
        }
    }

    public function changePassword(Request $request, string $id)
    {
        $data = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required',
            'new_password_confirmation' => 'required',
        ]);

        $user = User::findOrFail($id);

        // Memeriksa apakah kata sandi saat ini salah
        if (!Hash::check($data['current_password'], $user->password)) {
            return back()->withErrors([
                'current_password' => 'Kata sandi saat ini yang Anda masukkan salah, harap coba lagi.'
            ])->with('erorr', 'Kata sandi gagal diperbarui!');
        }

        // Memeriksa apakah kata sandi baru sama dengan kata sandi saat ini
        if ($data['new_password'] === $data['current_password']) {
            return back()->withErrors([
                'new_password' => 'Kata sandi baru harus berbeda dari kata sandi saat ini.'
            ])->with('erorr', 'Kata sandi gagal diperbarui!');
        }

        // Memperbarui kata sandi pengguna
        $user->update([
            'password' => bcrypt($data['new_password']),
        ]);

        // Redirect ke halaman profil dengan status success
        return redirect()->route('user.profile', $id)->with('status', 'Kata sandi Anda berhasil diperbarui!');
    }


    public function userProfile(string $id)
    {
        $user = User::findOrFail($id);
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

        $user = User::create($data);

        return redirect()->route('employee.index')->with('status', 'Berhasil menambahkan pengguna');
    }
}
