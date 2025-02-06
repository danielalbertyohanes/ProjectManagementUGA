<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Course;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $periodeAktif = Periode::where('status', 'active')->first();

        $totalPengguna = User::all()->count();

        $totalDosen = Dosen::all()->count();

        $hariIni = \Carbon\Carbon::today()->format('d-m-Y');

        if (Auth::user()->position_id == '2') {
            $courseBelumSelesai = Course::whereNotIn('status', ['Publish', 'Cancel'])
                ->where('pic_course', Auth::user()->id)
                ->count();
        } else {
            $courseBelumSelesai = Course::whereNotIn('status', ['Publish', 'Cancel'])->count();
        };

        //dd($periodeAktif, $totalPengguna,  $totalDosen,    $hariIni,   $courseBelumSelesai);

        return view('layouts.home', compact('periodeAktif', 'totalPengguna', 'totalDosen', 'hariIni', 'courseBelumSelesai'));
    }
}
