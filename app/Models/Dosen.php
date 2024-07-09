<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Dosen extends Model
{
    protected $fillable = [
        'name',
        'no_tlpn',
        'description'
    ];

    // function tambah dosen
    public static function createDosen($data)
    {
        return DB::table('dosens')->insert($data);
    }

    // function ambil data dosen
    public static function getAllDosens()
    {
        return DB::table('dosens')->get();
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
