<?php

namespace App\Http\Controllers;

use App\Models\Ppt;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Video;
use App\Models\Course;
use App\Models\LinkExternal;
use App\Models\Periode;
use App\Models\Topic;
use App\Models\SubTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\String_;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $links = LinkExternal::getLinkOrderedByStatusActive();
        $search = $request->input('search');
        $courses = Course::searchCourses($search);
        return view('course.index', compact('courses', 'links'));
    }

    public function show(String $course_id)
    {
        $course = Course::findOrFail($course_id);
        $topics = Topic::getTopicsByCourseId($course_id);
        $subTopics = SubTopic::getSubTopicsByCourseId($course_id);
        return view('course.detail', compact('course', 'topics', 'subTopics'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_course' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'jumlah_video' => 'nullable|integer',
            'pic_course' => 'required|integer',
            'periode_id' => 'required|integer',
            'drive_url' => 'nullable|string|max:255',
            'video_url' => 'nullable|string|max:255',
        ]);
        $course = Course::create($data);
        $course->periode()->attach($request->periode_id);
        $dosens = $request->input('dosens', []);
        foreach ($dosens as $key => $dosenId) {
            $role = $key === 0 ? 'ketua' : 'anggota';
            $course->dosens()->attach($dosenId, ['role' => $role]);
        }
        return redirect()->route('course.index')->with('status', 'Berhasil Tambah mata pelajaran');
    }

    public function getCreateForm()
    {
        $dosens = Dosen::getAllDosens();
        $pic = User::getUserPIC();
        $periode = Periode::getAllPeriodeActive();
        return response()->json([
            'status' => 'ok',
            'msg' => view('course.create', compact('pic', 'dosens', 'periode'))->render()
        ], 200);
    }

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'drive_url' => 'nullable|string|max:255',
            'video_url' => 'nullable|string|max:255',
        ]);
        $course->update($data);
        return redirect()->route('course.index')->with('status', 'Mata pelajaran berhasil diperbarui');
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('course.edit', compact('course'));
    }

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
            $deletedData->delete();
            return redirect()->route('course.index')->with('status', 'Horray ! Mata pelajaran Anda berhasil dihapus');
        } catch (\PDOException $ex) {
            $msg = "Gagal menghapus mata pelajaran! Pastikan tidak ada data terkait sebelum menghapusnya";
            return redirect()->route('course.index')->with('status', $msg);
        }
    }

    public function cancel($id)
    {
        $course = Course::findOrFail($id);
        $course->status = 'Cancel';
        $course->save();
        return redirect()->route('course.index')->with('status', 'Mata pelajaran telah dibatalkan');
    }

    public function open($id)
    {
        $course = Course::findOrFail($id);
        $progress = $course->progress;

        if ($progress == 0) {
            $course->status = 'Not Yet';
        } elseif ($progress > 0 && $progress <= 25) {
            $course->status = 'Progress';
        } elseif ($progress > 25 && $progress <= 50) {
            $course->status = 'Finish Production';
        } elseif ($progress > 50 && $progress <= 75) {
            $course->status = 'On Going CURATION';
        } elseif ($progress == 100) {
            $course->status = 'Publish';
        }
        $course->save();
        return redirect()->route('course.index')->with('status', 'Mata pelajaran telah dibuka');
    }

    public function catatRecording(Course $course, $action)
    {
        $allowedActions = ['kurasi', 'publish'];
        if (!in_array($action, $allowedActions)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tindakan tidak valid',
            ], 400);
        }
        $success = Course::catatTanggalRecording(Auth::id(), $course->id, $action);
        $new = Course::find($course->id);
        if ($success) {
            return response()->json([
                'status' => 'success',
                'message' => 'Tindakan berhasil tercatat',
                'progress' => $new->progress,
                'status_text' => $new->status,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Tindakan tidak valid atau gagal memperbarui',
            ], 400);
        }
    }

    public function checkButton($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return response()->json(['error' => 'Mata pelajaran tidak ditemukan'], 404);
        }
        $status = $course->status;
        $progress = $course->progress;

        return response()->json([
            'course' => [
                'status' => $status,
                'progress' => $progress
            ]
        ]);
    }
}
