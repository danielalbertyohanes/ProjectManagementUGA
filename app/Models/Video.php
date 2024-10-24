<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'videos';

    protected $fillable = [
        'name',
        'location',
        'detail_location',
        'recording_video_started_at',
        'recording_video_finished_at',
        'recording_ppt_started_at',
        'recording_ppt_finished_at',
        'editing_started_at',
        'editing_finished_at',
        'sent_at',
        'acc_at',
        'uploaded_at',
        'progress',
        'status',
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
        $user = $userId;
        $video = $videoId;
        $updateData = []; // Array untuk menyimpan data yang akan diupdate

        // Mencatat log tindakan
        $catat_log = LogVideo::create([
            'user_id' => $user,
            'video_id' => $video,
            'status' => match ($action) { // Menggunakan match expression untuk menetapkan status
                'start_recording_video' => 'Start',
                'pause_recording_video' => 'Pause',
                'finish_recording_video' => 'Finish',
                'start_recording_ppt' => 'Start',
                'pause_recording_ppt' => 'Pause',
                'finish_recording_ppt' => 'Finish',
                default => 'Unknown', // Status default jika action tidak dikenal
            },
            'description' => ucfirst(str_replace('_', ' ', $action)), // Deskripsi menggunakan tindakan yang dibaca
            'log_videocol' => 'Video Log', // Isi sesuai kebutuhan, misalnya 'Video Log'
        ]);

        if ($action == 'start_recording_video') {
            $updateData = [
                'started_at_video' => now()->toDateString(),
                'nilai_recording' => 10, // Nilai saat mulai video recording
            ];
        } elseif ($action == 'start_recording_ppt') {
            $updateData = [
                'started_at_ppt' => now()->toDateString(),
                'nilai_recordingppt' => 10, // Nilai saat mulai PPT recording
            ];
        } elseif ($action == 'pause_recording_video') {
            $updateData = [
                'latest_pause_click_video' => now()->toDateString(),
                'nilai_recording' => 20, // Nilai saat pause video recording
            ];
        } elseif ($action == 'pause_recording_ppt') {
            $updateData = [
                'latest_pause_click_ppt' => now()->toDateString(),
                'nilai_recordingppt' => 20, // Nilai saat pause PPT recording
            ];
        } elseif ($action == 'finish_recording_video') {
            // Menghitung durasi video recording
            $videoRecord = Video::find($video);
            if ($videoRecord && $videoRecord->started_at_video) {
                $durasi = DB::table('videos')
                    ->select(DB::raw('DATEDIFF(now(), started_at_video) AS durasi'))
                    ->where('id', $video)
                    ->value('durasi');

                $updateData = [
                    'latest_finish_click_video' => now()->toDateString(),
                    'durasi_recording' => $durasi,
                    'nilai_recording' => 30, // Nilai saat selesai video recording
                ];
            }
        } elseif ($action == 'finish_recording_ppt') {
            // Menghitung durasi PPT recording
            $videoRecord = Video::find($video);
            if ($videoRecord && $videoRecord->started_at_ppt) {
                $durasi = DB::table('videos')
                    ->select(DB::raw('DATEDIFF(now(), started_at_ppt) AS durasi'))
                    ->where('id', $video)
                    ->value('durasi');

                $updateData = [
                    'latest_finish_click_ppt' => now()->toDateString(),
                    'durasi_recordingppt' => $durasi,
                    'nilai_recordingppt' => 30, // Nilai saat selesai PPT recording
                ];
            }
        }

        // Melakukan update pada tabel video sesuai dengan data yang diubah
        if (!empty($updateData)) {
            Video::where('id', $video)->update($updateData);
        }

        // Mengembalikan informasi tentang log dan data yang diperbarui
        return [
            'log' => $catat_log,
            'updated_data' => $updateData,
        ];
    }
}
