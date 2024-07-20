<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LinkExternal extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'link_external';

    protected $fillable = [
        'name',
        'status',
        'value'
    ];
}
