<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'jumlah_video',
        'panduan_rpp_path',
        'template_rpp_path',
        'uploaded_rpp_path',
        'pic_course'
    ];

    protected $dates = ['delete_at'];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pic_course');
    }

    // function tambah data 
    public static function createCourse($data)
    {
        return DB::table('courses')->insert($data);
    }

    // function update
    public static function updateCourse($id, $data)
    {
        return DB::table('courses')->where('id', $id)->update($data);
    }

    // function delete
    public static function deleteCourse($id)
    {
        return DB::table('courses')->where('id', $id)->delete();
    }

    // function ambil data 
    public static function getAllCourses()
    {
        return DB::table('courses')->get();
    }

    // function cari course by id
    public static function findCourseById($id)
    {
        return DB::table('courses')->where('id', $id)->first();
    }
}
