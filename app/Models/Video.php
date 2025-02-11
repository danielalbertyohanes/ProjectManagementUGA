<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;


class Video extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'videos';

    protected $fillable = [
        'name',
        'location',
        'detail_location',
        'progress',
        'status',
        'started_at',
        'finished_at',
        'started_at_video',
        'pause_click_video',
        'finish_click_video',
        'started_at_ppt',
        'pause_click_ppt',
        'finish_click_ppt',
        'started_at_editing',
        'pause_click_editing',
        'finish_click_editing',
        'durasi_recording',
        'durasi_recordingppt',
        'durasi_editing',
        'nilai_recording',
        'nilai_recordingppt',
        'nilai_editing',
        'nilai_QA',
        'ppt_id'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ppt(): BelongsTo
    {
        return $this->belongsTo(Ppt::class, 'ppt_id');
    }

    public function subTopic()
    {
        return $this->ppt->subTopic();
    }

    public static function getVideosByCourseId($courseId)
    {
        return DB::table('videos')

            ->join('ppts', 'videos.ppt_id', '=', 'ppts.id')
            ->join('sub_topics', 'ppts.sub_topic_id', '=', 'sub_topics.id')
            ->join('topics', 'sub_topics.topic_id', '=', 'topics.id')
            ->join('courses', 'topics.course_id', '=', 'courses.id')
            ->where('courses.id', $courseId)
            ->select('videos.*', 'ppts.name as ppt_name')
            ->orderBy('videos.id', 'asc')
            ->get();
    }

    public static function getVideosBySubTopicId($subTopic)
    {
        return DB::table('videos')

            ->join('ppts', 'videos.ppt_id', '=', 'ppts.id')
            ->join('sub_topics', 'ppts.sub_topic_id', '=', 'sub_topics.id')
            ->where('sub_topics.id', $subTopic)
            ->select('videos.*', 'ppts.name as ppt_name')
            ->orderBy('videos.progress', 'asc')
            ->get();
    }
    //get status LogVideosController
    public static function getStatus()
    {
        return self::select('status')->get();
    }

    public static function catatTanggalRecording($userId, $videoId, $action)
    {
        $video = Video::findOrFail($videoId);
        if (!$video) {
            return response()->json(['message' => 'Video not found'], 404);
        }
        $updateData = [];

        // Mencatat log tindakan
        LogVideo::create([
            'user_id' => $userId,
            'video_id' => $videoId,
            'status' => match ($action) {
                'start-recording-video', 'start-recording-ppt', 'start-editing' => 'Start',
                'pause-recording-video', 'pause-recording-ppt' => 'Pause',
                'resume-recording-video', 'resume-recording-ppt' => 'Resume',
                'finish-recording-video', 'finish-recording-ppt', 'finish-editing' => 'Finish',
                default => 'Unknown',
            },
            'description' => ucfirst(str_replace('_', ' ', $action)),
        ]);

        // Mapping tindakan ke update data
        switch ($action) {
            case 'start-recording-video':
                $updateData = [
                    'started_at_video' => now(),
                    'nilai_recording' => 10,
                    'status' => 'Recording',
                ];
                if (!$video->started_at) {
                    $updateData['started_at'] = now();
                    $updateData['progress'] = 20;
                }
                break;

            case 'pause-recording-video':
                if ($video->started_at_video) {
                    $durasiKerja = Carbon::parse($video->started_at_video)->diffInDays(now());
                    $updateData = [
                        'pause_click_video' => now(),
                        'durasi_recording' => $video->durasi_recording + $durasiKerja,
                        'status' => 'Pause Recording',
                        'nilai_recording' => 20,
                        'started_at_video' => null,
                    ];
                }
                break;

            case 'finish-recording-video':
                if ($video->started_at_video) {
                    $durasiKerja = Carbon::parse($video->started_at_video)->diffInDays(now());
                    $updateData = [
                        'finish_click_video' => now(),
                        'durasi_recording' => $video->durasi_recording + $durasiKerja,
                        'nilai_recording' => 30,
                        'status' => 'Recorded',
                        'progress' => $video->started_at_ppt ? max(60, $video->progress) : max(40, $video->progress),
                    ];
                }
                break;

            case 'start-recording-ppt':
                $updateData = [
                    'started_at_ppt' => now(),
                    'nilai_recordingppt' => 10,
                    'status' => 'PPT Recording',
                ];
                if (!$video->started_at) {
                    $updateData['started_at'] = now();
                    $updateData['progress'] = 20;
                }
                break;

            case 'pause-recording-ppt':
                if ($video->started_at_ppt) {
                    $durasiKerja = Carbon::parse($video->started_at_ppt)->diffInDays(now());
                    $updateData = [
                        'pause_click_ppt' => now(),
                        'durasi_recordingppt' => $video->durasi_recordingppt + $durasiKerja,
                        'status' => 'Pause Recording',
                        'nilai_recordingppt' => 20,
                        'started_at_ppt' => null,
                    ];
                }
                break;

            case 'finish-recording-ppt':
                if ($video->started_at_ppt) {
                    $durasiKerja = Carbon::parse($video->started_at_ppt)->diffInDays(now());
                    $updateData = [
                        'finish_click_ppt' => now(),
                        'durasi_recordingppt' => $video->durasi_recordingppt + $durasiKerja,
                        'nilai_recordingppt' => 30,
                        'status' => 'PPT Recorded',
                        'progress' => $video->started_at_video ? max(60, $video->progress) : max(40, $video->progress),
                    ];
                }
                break;

            case 'start-editing':
                $updateData = [
                    'started_at_editing' => now(),
                    'nilai_editing' => 10,
                    'status' => 'Editing',
                    'progress' => 80,
                ];
                break;

            case 'finish-editing':
                if ($video->started_at_editing) {
                    $updateData = [
                        'finished_at' => now(),
                        'finish_click_editing' => now(),
                        'durasi_editing' => Carbon::parse($video->started_at_editing)->diffInDays(now()),
                        'nilai_editing' => 30,
                        'status' => 'Edited',
                        'progress' => 100,
                    ];
                }
                break;
        }

        if (!empty($updateData)) {
            $video->update($updateData);
            return response()->json(['message' => 'Video updated successfully']);
        }
        return response()->json(['message' => 'No update was made']);
    }
}
