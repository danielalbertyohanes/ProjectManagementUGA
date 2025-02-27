<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\LogPpt;
use App\Models\LogVideo;
use App\Models\Periode;
use App\Models\Ppt;
use App\Models\User;
use App\Models\Video;

class ReportController extends Controller
{
    public function rptCourse()
    {
        $periodes = Periode::all();
        $activePeriode = Periode::where('status', 'active')->first();
        $activePeriodeId = $activePeriode ? $activePeriode->id : null;

        // Get courses with their relationships and period
        $courses = Course::with([
            'topics.subTopics.ppts.videos' => fn($query) => $query->orderBy('name'),
        ])->get();

        $groupedByPic = $courses->groupBy(function ($course) {
            return $course->user->name;
        });

        return view('report.rptcourse', compact('courses', 'periodes', 'activePeriodeId', 'groupedByPic'));
    }
    public function rptEmployee()
    {
        // Get users with their related courses (where they are PIC)
        $users = User::with(['courses' => function ($query) {
            $query->select('courses.id', 'name', 'description', 'status', 'pic_course');
        }])
            ->withCount(['courses'])
            ->get();

        // Get PPT logs for each user
        $userPptLogs = LogPpt::with(['ppt' => function ($query) {
            $query->select('id', 'name', 'status');
        }])
            ->select('user_id', 'ppt_id', 'status', 'description', 'created_at')
            ->get()
            ->groupBy('user_id');

        // Get Video logs for each user
        $userVideoLogs = LogVideo::with(['video' => function ($query) {
            $query->select('id', 'name', 'status');
        }])
            ->select('user_id', 'video_id', 'status', 'description', 'created_at')
            ->get()
            ->groupBy('user_id');

        // Combine the data for each user
        $employeeReports = $users->map(function ($user) use ($userPptLogs, $userVideoLogs) {
            return [
                'user' => $user,
                'courses' => $user->courses,
                'courses_count' => $user->courses_count,
                'ppt_logs' => $userPptLogs->get($user->id, collect()),
                'video_logs' => $userVideoLogs->get($user->id, collect()),
                'total_tasks' => $userPptLogs->get($user->id, collect())->count() +
                    $userVideoLogs->get($user->id, collect())->count()
            ];
        });

        return view('report.rptemployee', compact('employeeReports'));
    }
    public function rptPeriode($periodeId = null)
    {
        $periodes = Periode::with(['course.topics.subTopics.ppts.videos'])->get()->map(function ($periode) {
            // Hitung total PPT dan video untuk seluruh periode
            $totalPPTs = $periode->course->sum(function ($course) {
                return $course->topics->sum(function ($topic) {
                    return $topic->subTopics->sum(function ($subTopic) {
                        return $subTopic->ppts->count();
                    });
                });
            });

            $totalVideos = $periode->course->sum(function ($course) {
                return $course->topics->sum(function ($topic) {
                    return $topic->subTopics->sum(function ($subTopic) {
                        return $subTopic->videos->count();
                    });
                });
            });

            // Ambil detail course per periode
            $courses = $periode->course->map(function ($course) {
                return [
                    'name' => $course->name,
                    'status' => $course->status,
                    'total_topics' => $course->topics->count(),
                    'total_subtopics' => $course->topics->sum(fn($topic) => $topic->subTopics->count()), // Total subtopic per course
                    'total_ppts' => $course->topics->sum(fn($topic) => $topic->subTopics->sum(fn($subTopic) => $subTopic->ppts->count())), // Total PPT per course
                    'total_videos' => $course->topics->sum(fn($topic) => $topic->subTopics->sum(fn($subTopic) => $subTopic->videos->count())), // Total video per course
                ];
            });

            return [
                'id' => $periode->id,
                'name' => $periode->name,
                'start_date' => $periode->start_date,
                'end_date' => $periode->end_date,
                'kurasi_date' => $periode->kurasi_date,
                'status' => $periode->status,
                'open_courses_count' => $periode->course->count(),
                'total_topics' => $periode->course->sum(fn($course) => $course->topics->count()),
                'total_subtopics' => $periode->course->sum(fn($course) => $course->topics->sum(fn($topic) => $topic->subTopics->count())),
                'completed_courses' => $periode->course->where('status', 'Publish')->count(),
                'not_completed_courses' => $periode->course->where('status', '!=', 'Publish')->count(),
                'progress_percentage' => $periode->course->count() > 0
                    ? round(($periode->course->where('status', 'Publish')->count() / $periode->course->count()) * 100, 2)
                    : 0,
                'total_ppts' => $totalPPTs,
                'total_videos' => $totalVideos,
                'courses' => $courses, // Detail course per periode
            ];
        });
        return view('report.rptperiode', compact('periodes'));
    }
}
