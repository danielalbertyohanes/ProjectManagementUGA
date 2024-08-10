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
    //get all
    public static function logVideos()
    {
        return self::all();
    }
    //get log (status, desc)
    public static function getStatusAndDesc($user_id, $video_id)
    {
        return self::select('status', 'description')
            ->where($user_id, $video_id)
            ->get();
    }
    //update 
    public static function updateLog($user_id, $video_id, $data)
    {
        $log = self::where($user_id, $video_id)->first();
        if ($log) {
            $log->update($data);
            return $log;
        }
        return null;
    }
}
