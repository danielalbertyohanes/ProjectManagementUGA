<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class SubTopic extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'status',
        'progress',
        'topic_id',
    ];
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class, 'topic_id');
    }

    public function ppts(): HasMany
    {
        return $this->hasMany(Ppt::class, 'sub_topic_id', 'id');
    }
    // Get all topics
    public static function getAllSubTopics()
    {
        return self::all();
    }
    // Get subtopics by topic_id.
    public static function getSubTopicsByCourseId($course_id)
    {
        return self::join('topics', 'sub_topics.topic_id', '=', 'topics.id')->join('courses', 'topics.course_id', '=', 'courses.id')
            ->select(
                'topics.name as topic_name',
                'sub_topics.*'
            )
            ->where('courses.id', $course_id)
            ->orderBy('sub_topics.name', 'asc')  // Mengurutkan berdasarkan kolom 'created_at'
            ->get();
    }


    // Insert subtopics
    public static function insertSubTopics($data)
    {
        return self::create($data);
    }
    // Update topic by ID
    public static function updateSubTopic($id, $data)
    {
        $subTopic = self::find($id);
        if ($subTopic) {
            $subTopic->update($data);
            return $subTopic;
        }
        return null;
    }
    public static function findSubTopicById($id)
    {
        return DB::table('sub_topics')->where('id', $id)->first();
    }
}
