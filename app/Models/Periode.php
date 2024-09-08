<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Periode extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'periode';
    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'kurasi_date',
        'status'
    ];

    public function course()
    {
        return $this->belongsToMany(Course::class, 'course_has_periode', 'periode_id', 'courses_id');
    }

    public static function getAllPeriodeActive()
    {
        return DB::table('periode')
            ->orderBy('name', 'asc')
            ->where('status', 'active')
            ->get();
    }
    public static function getAllPeriode()
    {
        return DB::table('periode')
            ->orderBy('name', 'asc')
            ->get();
    }
}
