<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Periode;


class ReportController extends Controller
{
    public function index()
    {
        $periodes = Periode::all(); // Assuming you have a Periode model
        $activePeriode = Periode::where('status', 'active')->first();
        $activePeriodeId = $activePeriode ? $activePeriode->id : null;

        $courses = Course::with([
            'topics.subTopics.ppts.videos' => fn($query) => $query->orderBy('name'),
        ])->get();
        //dd($courses);
        $groupedByPic = $courses->groupBy(function ($course) {
            return $course->user->name;
        });

        return view('report.index', compact('courses', 'periodes', 'activePeriodeId', 'groupedByPic'));
    }
}
