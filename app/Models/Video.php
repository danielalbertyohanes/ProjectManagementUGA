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

        'status',
        'progres',
        'recording_started_at',
        'recording_finished_at',
        'location',
        'detail_location',
        'editing_started_at',
        'editing_finished_at',
        'sended_at',
        'acc_at',
        'url_video',
        'uploaded_at',
        'user_id',
        'ppts_id',
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
            ->join('users', 'videos.user_id', '=', 'users.id')
            ->join('ppts', 'videos.ppt_id', '=', 'ppts.id')
            ->join('sub_topics', 'ppts.sub_topic_id', '=', 'sub_topics.id')
            ->join('topics', 'sub_topics.topic_id', '=', 'topics.id')
            ->join('courses', 'topics.course_id', '=', 'courses.id')
            ->where('courses.id', $courseId)
            ->select('videos.*', 'users.name as staf_name', 'ppts.name as ppt_name')
            ->orderBy('videos.id', 'asc')
            ->get();
    }
}
