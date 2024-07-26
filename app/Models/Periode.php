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

    public static function getAllPeriode()
    {
        return DB::table('periode')
            ->orderBy('name', 'asc')
            ->whereNull('deleted_at')
            ->get();
    }
}
