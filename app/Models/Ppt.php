<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Ppt extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ppts';

    protected $fillable = [
        'name',
        'progress',
        'status',
        'started_at',
        'finished_at',
        'start_click_ppt',
        'pause_click_ppt',
        'finish_click_ppt',
        'durasi_editing',
        'nilai_editing',
        'created_at',
        'updated_at',
        'deleted_at',
        'user_id',
        'sub_topic_id',
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'sub_topic_id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'ppt_id');
    }

    public function subTopic(): BelongsTo
    {
        return $this->belongsTo(SubTopic::class, 'sub_topic_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vidoes(): HasMany
    {
        return $this->hasMany(Video::class, 'ppt_id', 'id');
    }
    public static function getPptsByCourseId($courseId)
    {
        return DB::table('ppts')
            ->join('sub_topics', 'ppts.sub_topic_id', '=', 'sub_topics.id')
            ->join('topics', 'sub_topics.topic_id', '=', 'topics.id')
            ->join('courses', 'topics.course_id', '=', 'courses.id')
            ->where('courses.id', $courseId)
            ->select('ppts.*')
            ->orderBy('ppts.id', 'asc')
            ->get();
    }

    public static function getPptsBySubTopicId($subTopic)
    {
        return DB::table('ppts')
            ->join('sub_topics', 'ppts.sub_topic_id', '=', 'sub_topics.id')
            ->where('sub_topics.id', $subTopic)
            ->select('ppts.*')
            ->orderBy('ppts.id', 'asc')
            ->get();
    }
    function getPptProgressFromStatus($status)
    {
        $statusMap = [
            'Not Yet' => 0,
            'Cancel' => 0,
            'Progress' => 50,
            'Finished' => 100
        ];

        return $statusMap[$status] ?? 0;
    }

    public static function catatTanggalRecording($userId, $pptId, $action)
    {
        $updateData = []; // Array untuk menyimpan data yang akan diupdate

        $Ppt = Ppt::findOrFail($pptId); // or use findOrFail($videoId) to throw an error if not found

        if ($Ppt) {

            // Mencatat log tindakan
            $catat_log = LogPpt::create([
                'user_id' => $userId,
                'ppt_id' => $pptId,
                'status' => match ($action) {
                    'start-ppt-editing' => 'Start',
                    'finish-ppt-editing' => 'Finish',
                    default => 'Unknown',
                },
                'description' => ucfirst(str_replace('_', ' ', $action)), // Deskripsi menggunakan tindakan yang dibaca
            ]);


            // Aksi terkait PPT
            if ($action === 'start-ppt-editing') {
                $updateData = [
                    'started_at' => now(),
                    'start_click_ppt' => now(),
                    'nilai_editing' => 50,
                    'status' => 'Progress',
                    'progress' => 50
                ];
            } elseif ($action === 'finish-ppt-editing') {
                $newppt = Ppt::find($pptId);
                if ($newppt && $newppt->start_click_ppt) {
                    $durasi = Carbon::parse($newppt->start_click_ppt)->diffInDays(now());
                    $updateData = [
                        'finished_at' => now()->toDateString(),
                        'finish_click_ppt' => now(),
                        'durasi_editing' => $durasi,
                        'nilai_editing' => 100,
                        'status' => 'Finished',
                        'progress' => 100,
                    ];
                }
            }


            $updated = $Ppt->update($updateData);
            //dd($updateData);
            if ($updated) {
                // Optionally, return success response
                return response()->json(['message' => 'PPT updated successfully']);
            } else {
                // Handle failure if the update fails
                return response()->json(['message' => 'Failed to update PPT']);
            }
        } else {
            // Handle case where the video is not found
            return response()->json(['message' => 'PPT not found'], 404);
        }
    }
}
