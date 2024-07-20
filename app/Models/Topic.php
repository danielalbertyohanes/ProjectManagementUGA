<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topic extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'course_id',
        'deleted_at',
        'status',
        'progres'
    ];

    protected $dates = ['deleted_at'];

    public function courses(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function sub_topics(): HasMany
    {
        return $this->hasMany(SubTopic::class, 'topic_id', 'id');
    }

    // Get all topics.
    public static function getAllTopics()
    {
        return self::all();
    }

    // Get topics by course_id
    public static function getTopicsByCourseId($course_id)
    {
        return self::where('course_id', $course_id)->get();
    }

    // Insert topics
    public static function insertTopics($data)
    {
        return self::create($data);
    }

    // Update topic by ID
    public static function updateTopic($id, $data)
    {
        $topic = self::find($id);
        if ($topic) {
            $topic->update($data);
            return $topic;
        }
        return null;
    }
}
