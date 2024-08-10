<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogPpt extends Model
{
    use HasFactory;

    protected $table = 'log_ppt';

    protected $fillable = [
        'status',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
        'user_id',
        'ppt_id',
    ];

    // If the `deleted_at` column is used for soft deletes
    protected $dates = ['deleted_at'];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ppt()
    {
        return $this->belongsTo(Ppt::class);
    }
    //get log
    public static function getAllLogPpt()
    {
        return self::all();
    }
    //get log (status, desc)
    public static function getStatusAndDesc($user_id, $ppt_id)
    {
        return self::select('status', 'description')
            ->where($user_id, $ppt_id)
            ->get();
    }
    //update 
    public static function updateLog($user_id, $ppt_id, $data)
    {
        $log = self::where($user_id, $ppt_id)->first();
        if ($log) {
            $log->update($data);
            return $log;
        }
        return null;
    }
}
