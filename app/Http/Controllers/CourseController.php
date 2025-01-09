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
        // Ambil data links eksternal yang diurutkan berdasarkan status aktif
        $links = LinkExternal::getLinkOrderedByStatusActive();

        // Ambil kata kunci pencarian jika ada
        $search = $request->input('search');

        // Panggil method di model untuk pencarian dan filter berdasarkan posisi user
        $courses = Course::searchCourses($search, Auth::user()->id, Auth::user()->position_id);

        // Kembalikan view dengan data courses dan links
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

        // Simpan data kursus
        $course = Course::create($data);

        $course->periode()->attach($request->periode_id);

        // Simpan relasi dosen
        $dosens = $request->input('dosens', []);

        foreach ($dosens as $key => $dosenId) {
            $role = $key === 0 ? 'ketua' : 'anggota'; // Dosen pertama menjadi ketua, yang lainnya anggota
            $course->dosens()->attach($dosenId, ['role' => $role]);
        }

        return redirect()->route('course.index')->with('status', 'Berhasil Tambah');
    }

    /**
     * Show the form for creating a new resource.
     */

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


    // app/Http/Controllers/CourseController.php

    public function update(Request $request, Course $course)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'jumlah_video' => 'nullable|integer',
            'status' => 'required|in:Not Yet,Progres,Finish,Cancel',
            'drive_url' => 'nullable|string|max:255',
            'video_url' => 'nullable|string|max:255',
        ]);


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

    public function cancel($id)
    {
        // Cari course berdasarkan ID
        $course = Course::findOrFail($id);

        // Ubah status course menjadi 'cancel'
        $course->status = 'Cancel';
        $course->save();

        // Redirect dengan pesan sukses
        return redirect()->route('course.index')->with('status', 'Course has been canceled.');
    }


    public function open($id)
    {
        // Cari course berdasarkan ID
        $course = Course::findOrFail($id);
        $progress =  $course->progress;

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

        // Redirect dengan pesan sukses
        return redirect()->route('course.index')->with('status', 'Course has been opened.');
    }


    public function showAjax(Request $request)
    {
        $course_id = $request->get('course_id'); // Pastikan nama parameter sesuai dengan yang dikirim dari AJAX

        // Ambil data berdasarkan ID yang sesuai
        $ppts = Ppt::getPptsByCourseId($course_id);
        $videos = Video::getVideosByCourseId($course_id);
        $topics = Topic::getTopicsByCourseId($course_id);
        $subtopics = SubTopic::getSubTopicsByTopicId($course_id); // Gunakan $subtopics sesuai nama variabel

        // Render HTML untuk masing-masing bagian
        $pptHtml = view('ppt.ppt_table', compact('ppts'))->render();
        $videoHtml = view('video.video_table', compact('videos'))->render();
        $topicHtml = view('topic.topic_table', compact('topics'))->render();
        $subTopicHtml = view('subTopic.subTopic_table', compact('subtopics'))->render(); // Pastikan nama variabel konsisten

        return response()->json([
            'msg' => $topicHtml . $subTopicHtml .  $pptHtml . $videoHtml
        ], 200);
    }
    public function catatRecording(Course $course, $action)
    {

        $allowedActions = ['kurasi', 'publish'];
        if (!in_array($action, $allowedActions)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid action',
            ], 400);
        }

        // Panggil metode catatTanggalRecording dari model
        $success = Course::catatTanggalRecording(Auth::id(), $course->id, $action);
        $new = Course::find($course->id);

        if ($success) {
            return response()->json([
                'status' => 'success',
                'message' => 'Action recorded successfully',
                'progress' => $new->progress,
                'status_text' => $new->status,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid action or failed to update',
            ], 400);
        }
    }
    public function checkButton($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }

        // Logic to determine button states
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
