<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Dosen extends Model
{

    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'npk',
        'fakultas',
        'no_telp',
        'description'
    ];
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_has_dosen', 'dosens_id', 'courses_id')
            ->withPivot('role');
    }

    // function tambah dosen
    public static function createDosen($data)
    {
        return DB::table('dosens')->insert($data);
    }

    // Function to retrieve all dosens
    public static function getAllDosens()
    {
        return DB::table('dosens')
            ->orderBy('name', 'asc')
            ->whereNull('deleted_at')
            ->get();
    }

    // function cari nama dosen
    public static function getDosenById($id)
    {
        return DB::table('dosens')->where('id', $id)->first();
    }

    // Update dosen
    public static function updateDosen($id, $data)
    {
        return DB::table('dosens')->where('id', $id)->update($data);
    }

    // Delete dosen
    public static function deleteDosen($id)
    {
        return DB::table('dosens')->where('id', $id)->delete();
    }
}
