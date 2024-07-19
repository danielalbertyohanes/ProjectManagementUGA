<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    public function course()
    {
        return $this->belongsTo(Course::class);
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
