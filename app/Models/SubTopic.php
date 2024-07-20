<?php

namespace App\Models;

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
        'created_at',
        'updated_at',
        'deleted_at',
        'topic_id',
        'progres',
        'status'
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
    // Get topics by course_id.
    public static function getTopicsByCourseId($topic_id)
    {
        return self::where('topic_id', $topic_id)->get();
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
}
