<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $courses = Course::with([
            'topics.subTopics.ppts.videos' => fn($query) => $query->orderBy('name'),
        ])->get();

        return view('report.index', compact('courses'));
    }
}
