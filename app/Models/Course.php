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
        return $this->belongsToMany(Dosen::class, 'courses_has_dosens', 'courses_id', 'dosens_id')
            ->withPivot('role');
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
}
