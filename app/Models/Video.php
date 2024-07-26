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
}
