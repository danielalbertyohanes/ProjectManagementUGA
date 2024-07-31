<?php

namespace App\Http\Controllers;

use App\Models\Ppt;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Video;
use App\Models\Course;
use App\Models\LinkExternal;
use App\Models\Topic;
use App\Models\SubTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\String_;

class CourseController extends Controller
{
    public function index()
    {
        $links = LinkExternal::getLinkOrderedByStatusActive();
        $courses = Course::getAllCourses();
        return view('course.index', compact('courses', 'links'));
    }

    public function show(String $course_id)
    {
        $course = Course::findCourseById($course_id);
        $topics = Topic::getTopicsByCourseId($course_id);
        $subTopics = SubTopic::getSubTopicsByCourseId($course_id);
        return view('course.detail', compact('course', 'topics', 'subTopics'));
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'jumlah_video' => 'nullable|integer',
            'pic_course' => 'required|integer',
        ]);

        // Simpan data kursus
        $course = Course::create($data);

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
    public function create()
    {
        $dosens = Dosen::getAllDosens();
        $pic = User::getUserPIC();
        return view("course.create", compact('pic', 'dosens'));
    }

    public function getCreateForm()
    {
        $dosens = Dosen::getAllDosens();
        $pic = User::getUserPIC();
        return response()->json([
            'status' => 'ok',
            'msg' => view('course.create', compact('pic', 'dosens'))->render()
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
}
