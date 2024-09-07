<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogVideo extends Model
{
    use HasFactory;

    protected $table = 'log_video';

    protected $fillable = [
        'status',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
        'user_id',
        'video_id',
    ];

    // If the `deleted_at` column is used for soft deletes
    protected $dates = ['deleted_at'];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    // Get all log videos
    public static function logVideos()
    {
        return self::all();
    }

    // Get status and description for a specific user and video
    public static function getStatusAndDesc($user_id, $video_id)
    {
        return self::select('status', 'description')
            ->where('user_id', $user_id)
            ->where('video_id', $video_id)
            ->get();
    }

    // Update log entry based on user_id and video_id
    public static function updateLog($user_id, $video_id, $data)
    {
        $log = self::where('user_id', $user_id)
            ->where('video_id', $video_id)
            ->first();

        if ($log) {
            $log->update($data);
            return $log;
        }

        return null;
    }

    // Insert a new log entry
    public static function insertLogVideo($data)
    {
        return self::create($data);
    }
}
