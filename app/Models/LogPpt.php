<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogPpt extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'log_ppt';

    protected $fillable = [
        'ppt_id',
        'status',
        'description',
        'user_id',
    ];

    // Jika kolom `deleted_at` digunakan untuk soft deletes
    protected $dates = ['deleted_at'];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan PPT
    public function ppt()
    {
        return $this->belongsTo(Ppt::class);
    }

    public static function insertLogPpt($data)
    {
        return self::create($data);
    }
}
