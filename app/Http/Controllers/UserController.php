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
}
