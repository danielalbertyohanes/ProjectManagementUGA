<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Potition extends Model
{
    use HasFactory;

    protected $table = 'potitions';

    protected $fillable = [
        'name'
    ];
}
