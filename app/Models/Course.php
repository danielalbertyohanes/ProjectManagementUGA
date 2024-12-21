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
    protected $table = 'courses';
    protected $fillable = [
        'kode_course',
        'name',
        'description',
        'jumlah_video',
        'progress',
        'status',
        'pic_course',
        'drive_url',
        'video_url'

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
        return Course::with(['user', 'dosens', 'periode'])
            ->whereNull('deleted_at')
            ->orderBy('name', 'asc')
            ->get();
    }

    // function cari course by id


    public static function searchCourses($search, $userId, $positionId)
    {
        // Inisiasi query dasar
        $query = self::with('dosens', 'periode')
            ->join('course_has_periode', 'courses.id', '=', 'course_has_periode.courses_id')
            ->join('periode', 'course_has_periode.periode_id', '=', 'periode.id')
            ->where('periode.status', 'active')
            ->select('courses.*', 'periode.status as periode_status')
            ->orderBy('courses.name', 'asc')
            ->orderBy('courses.status', 'asc')
            ->orderBy('courses.progress', 'asc');


        // Jika position_id = 2, filter berdasarkan PIC
        if ($positionId == 2) {
            $query->where('pic_course', $userId);
        }

        // Tambahkan filter pencarian jika ada
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('courses.name', 'like', '%' . $search . '%')
                    ->orWhere('courses.kode_course', 'like', '%' . $search . '%')
                    ->orWhere('courses.description', 'like', '%' . $search . '%')
                    ->orderBy('courses.name', 'asc')
                    ->orderBy('courses.status', 'asc')
                    ->orderBy('courses.progress', 'asc');
            });
        }

        // Ambil hasil query
        return $query->get();
    }

    public static function catatTanggalRecording($userId, $courseId, $action)
    {
        $updateData = [];

        // Logika untuk menentukan update data berdasarkan action
        if ($action === 'kurasi') {
            $updateData = [
                'progress' => 75,
                'status' => 'On Going CURATION',
            ];
        } elseif ($action === 'publish') {
            $updateData = [
                'progress' => 100,
                'status' => 'Publish',
            ];
        } else {
            // Jika action tidak valid, return false (atau bisa lempar exception)
            return false;
        }
        //dd($updateData);

        // Cari dan update course
        $course = self::findOrFail($courseId); // Akan throw exception jika tidak ditemukan
        $course->update($updateData);

        // // Tambahkan log pengguna yang mengupdate (opsional)
        // $course->updated_by = $userId;
        // $course->save();

        return true; // Indikasi bahwa update berhasil
    }
}
