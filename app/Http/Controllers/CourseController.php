<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::getAllCourses();
        return view('courses.index', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::getCourseById($id);
        return view('courses.show', compact('course'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'jumlah_video' => 'nullable|integer',
            'panduan_rpp_path' => 'nullable|string',
            'template_rpp_path' => 'nullable|string',
            'uploaded_rpp_path' => 'nullable|string',
            'pic_course' => 'required|integer'
        ]);

        Course::createCourse($data);

        return redirect()->route('courses.index');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'jumlah_video' => 'nullable|integer',
            'panduan_rpp_path' => 'nullable|string',
            'template_rpp_path' => 'nullable|string',
            'uploaded_rpp_path' => 'nullable|string',
            'pic_course' => 'required|integer'
        ]);

        Course::updateCourse($id, $data);

        return redirect()->route('courses.index');
    }

    public function destroy($id)
    {
        Course::deleteCourse($id);

        return redirect()->route('courses.index');
    }
}
