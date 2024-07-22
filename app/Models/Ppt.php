<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ppt extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'ppts';

    protected $fillable = [
        'drive_url',
        'user_id',
        'sub_topic_id',
        'name',
        'progres',
        'status'
    ];

    public function subTopic()
    {
        return $this->belongsTo(SubTopic::class, 'sub_topic_id');
    }

    public function user()
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
}
