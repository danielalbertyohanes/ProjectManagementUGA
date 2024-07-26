<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'npk',
        'no_telp',
        'email',
        'password',
        'position_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id');
    }

    public  function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'pic_course', 'id');
    }

    public  function videos(): HasMany
    {
        return $this->hasMany(Video::class, 'user_id', 'id');
    }

    public  function ppts(): HasMany
    {
        return $this->hasMany(Ppt::class, 'user_id', 'id');
    }

    // function cari nama dosen
    public static function getUserPIC()
    {
        return DB::table('users')->where('position_id', 1)->get();
    }
    //show employee
    public static function getEmployee()
    {
        return DB::table('users')
            ->join('positions', 'users.position_id', '=', 'positions.id')
            ->select('users.npk', 'users.name as user_name', 'positions.name as position_name', 'users.email', 'users.no_telp')
            ->orderBy('users.position_id')
            ->get();
    }
}
