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
        $updateData = []; // Array untuk menyimpan data yang akan diupdate

        $video = Video::findOrFail($videoId); // or use findOrFail($videoId) to throw an error if not found

        if ($video) {

            // Mencatat log tindakan
            $catat_log = LogVideo::create([
                'user_id' => $userId,
                'video_id' => $videoId,
                'status' => match ($action) {
                    'start-video', 'start-ppt', 'start-editing' => 'Start',
                    'pause-video', 'pause-ppt' => 'Pause',
                    'finish-video', 'finish-ppt', 'finish-editing' => 'Finish',
                    default => 'Unknown',
                },
                'description' => ucfirst(str_replace('_', ' ', $action)), // Deskripsi menggunakan tindakan yang dibaca
            ]);



            // Aksi terkait Video
            if ($action === 'start-video') {
                $updateData = [
                    'started_at_video' => now()->toDateString(),
                    'nilai_recording' => 10,
                    'status' => 'Recording'
                ];

                $videoRecord = Video::find($videoId);
                if (!$videoRecord->started_at) {
                    $updateData['started_at'] = now()->toDateTimeString();
                    $updateData['progress'] = 20;
                }
            } elseif ($action === 'pause-video') {
                $updateData = [
                    'pause_click_video' => now()->toDateString(),
                    'nilai_recording' => 20,
                    'status' => 'Pause Recording'
                ];
            } elseif ($action === 'finish-video') {
                $videoRecord = Video::find($videoId);
                if ($videoRecord && $videoRecord->started_at_video) {
                    $durasi = Carbon::parse($videoRecord->started_at_video)->diffInDays(now());
                    $updateData = [
                        'finish_click_video' => now(),
                        'durasi_recording' => $durasi,
                        'nilai_recording' => 30,
                        'status' => 'Recorded',
                    ];
                    // Check if video is also finished
                    if ($videoRecord->started_at_ppt) {
                        $updateData['progress'] = max(60, $videoRecord->progress); // Ensure progress is not downgraded
                    } else {
                        $updateData['progress'] = max(40, $videoRecord->progress);
                    }
                }
            }

            // Aksi terkait PPT
            if ($action === 'start-ppt') {
                $updateData = [
                    'started_at_ppt' => now()->toDateString(),
                    'nilai_recordingppt' => 10,
                    'status' => 'PPT Recording'
                ];

                $videoRecord = Video::find($videoId);
                if (!$videoRecord->started_at) {
                    $updateData['started_at'] = now()->toDateTimeString();
                    $updateData['progress'] = 20;
                }
            } elseif ($action === 'pause-ppt') {
                $updateData = [
                    'pause_click_ppt' => now()->toDateString(),
                    'nilai_recordingppt' => 20,
                    'status' => 'Pause Recording'
                ];
            } elseif ($action === 'finish-ppt') {
                $videoRecord = Video::find($videoId);
                if ($videoRecord && $videoRecord->started_at_ppt) {
                    $durasi = Carbon::parse($videoRecord->started_at_ppt)->diffInDays(now());
                    $updateData = [
                        'finish_click_ppt' => now(),
                        'durasi_recordingppt' => $durasi,
                        'nilai_recordingppt' => 30,
                        'status' => 'PPT Recorded',
                        'progress' => 60,
                    ];
                    // Check if video is also finished
                    if ($videoRecord->started_at_video) {
                        $updateData['progress'] = max(60, $videoRecord->progress); // Ensure progress is not downgraded
                    } else {
                        $updateData['progress'] = max(40, $videoRecord->progress);
                    }
                }
            }

            // Aksi terkait Editing
            if ($action === 'start-editing') {
                $updateData = [
                    'started_at_editing' => now()->toDateString(),
                    'nilai_editing' => 10,
                    'status' => 'Editing',
                    'progress' => 80,
                ];
            } elseif ($action === 'finish-editing') {
                $videoRecord = Video::find($videoId);
                if ($videoRecord && $videoRecord->started_at_editing) {
                    $durasi = Carbon::parse($videoRecord->started_at_editing)->diffInDays(now());
                    $updateData = [
                        'finished_at' => now(),
                        'finish_click_editing' => now(),
                        'durasi_editing' => $durasi,
                        'nilai_editing' => 30,
                        'status' => 'Edited',
                        'progress' => 100,
                    ];
                }
            }

            $updated = $video->update($updateData);
            //dd($updateData);
            if ($updated) {
                // Optionally, return success response
                return response()->json(['message' => 'Video updated successfully']);
            } else {
                // Handle failure if the update fails
                return response()->json(['message' => 'Failed to update video']);
            }
        } else {
            // Handle case where the video is not found
            return response()->json(['message' => 'Video not found'], 404);
        }
    }
}
