<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'kode_course',
        'name',
        'description',
        'jumlah_video',
        'progres',
        'status',
        'pic_course',
        'updated_at',
        'created_at'

    ];
    public function topics(): HasMany
    {
        return $this->hasMany(Topic::class, 'course_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pic_course');
    }
    public function dosens()
    {
        return $this->belongsToMany(Dosen::class, 'course_has_dosen', 'courses_id', 'dosens_id')
            ->withPivot('role');
    }

    public function periode()
    {
        return $this->belongsToMany(Periode::class, 'course_has_periode', 'courses_id', 'periode_id');
    }

    // function tambah data 
    public static function createCourse(array $data)
    {
        return DB::table('courses')->insert($data);
    }

    // // function update
    // public static function updateCourse($id, $data)
    // {
    //     return DB::table('courses')->where('id', $id)->update($data);
    // }

    // // function delete
    // public static function deleteCourse($id)
    // {
    //     return DB::table('courses')->where('id', $id)->delete();
    // }

    // function ambil data 
    public static function getAllCourses()
    {
        return Course::with(['user', 'dosens'])
            ->whereNull('deleted_at')
            ->orderBy('name', 'asc')
            ->get();
    }

    // function cari course by id
    public static function findCourseById($id)
    {
        return DB::table('courses')->where('id', $id)->first();
    }

    public static function searchCourses($search, $userId, $positionId)
    {
        // Inisiasi query dasar
        $query = self::with('dosens', 'periode')
            ->join('course_has_periode', 'courses.id', '=', 'course_has_periode.courses_id')
            ->join('periode', 'course_has_periode.periode_id', '=', 'periode.id')
            ->where('periode.status', 'active') // Hanya periode aktif
            ->select('courses.*', 'periode.status as periode_status');

        // Jika position_id = 2, filter berdasarkan PIC
        if ($positionId == 2) {
            $query->where('pic_course', $userId);
        }

        // Tambahkan filter pencarian jika ada
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('courses.name', 'like', '%' . $search . '%')
                    ->orWhere('courses.kode_course', 'like', '%' . $search . '%')
                    ->orWhere('courses.description', 'like', '%' . $search . '%');
            });
        }

        // Ambil hasil query
        return $query->get();
    }
}
