<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function index()
    {

        $courses = Course::with('user')->get();
        return view('course.index', compact('courses'));
    }

    public function show($id)
    {
        $course = Course::getCourseById($id);
        return view('course.show', compact('course'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'jumlah_video' => 'nullable|integer',
            'panduan_rpp_path' => 'nullable|string',
            'template_rpp_path' => 'nullable|string',
            'pic_course' => 'required|integer'
        ]);
        Course::create($data);

        return redirect()->route('course.index')->with('status', 'Berhasil Tambah');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pic = User::getUserPIC();
        return view("course.create", compact('pic'));
    }

    // app/Http/Controllers/CourseController.php


    public function update(Request $request, Course $course)
    {
        // Validasi data input
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'jumlah_video' => 'nullable|integer',
            'panduan_rpp_path' => 'nullable|string',
            'template_rpp_path' => 'nullable|string'
        ]);

        // Perbarui data course menggunakan metode update
        $course->update($data);

        return redirect()->route('course.index')->with('status', 'Course updated successfully');
    }

    public function edit($id)
    {

        $course = Course::findOrFail($id);
        return view('course.edit', compact('course'));
    }

    // app/Http/Controllers/CourseController.php

    public function getEditForm(Request $request)
    {
        $id = $request->id;
        $course = Course::findOrFail($id);
        return response()->json([
            'status' => 'ok',
            'msg' => view('course.edit', compact('course'))->render()
        ], 200);
    }


    public function destroy(Course $course)
    {

        try {
            $deletedData = $course;
            //dd($deletedData);
            $deletedData->delete();
            return redirect()->route('course.index')->with('status', 'Horray ! Your data is successfully deleted !');
        } catch (\PDOException $ex) {

            $msg = "Failed to delete data ! Make sure there is no related data before deleting it";
            return redirect()->route('course.index')->with('status', $msg);
        }
    }
}
