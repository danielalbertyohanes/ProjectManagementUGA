<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Position extends Model
{
    use HasFactory;

    protected $table = 'positions';

    protected $fillable = [
        'name'
    ];

    public  function users(): HasMany
    {
        return $this->hasMany(User::class, 'position_id', 'id'); // hasmany buat many karena 1 hotel bisa banyak product
    }


    public static function getAll()
    {
        return Position::all();
    }
}
