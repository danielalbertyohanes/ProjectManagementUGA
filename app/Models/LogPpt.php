<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogPpt extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'log_ppt';

    protected $fillable = [
        'status',
        'ppt_id',
        'description',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
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


    public static function getLogPpt($ppt_id)
    {
        return DB::table('log_ppt')
            ->join('users', 'log_ppt.user_id', '=', 'users.id')  // Join dengan tabel 'users' berdasarkan 'user_id'
            ->join('ppts', 'log_ppt.ppt_id', '=', 'ppts.id')      // Join dengan tabel 'ppt' berdasarkan 'ppt_id'
            ->where('log_ppt.ppt_id', $ppt_id)
            ->select('log_ppt.*', 'users.name as user_name', 'ppts.name as ppt_name') // Pilih kolom yang dibutuhkan
            ->orderBy('log_ppt.id', 'DESC')
            ->get();  // Menggunakan first() untuk mendapatkan satu entitas
    }
}
