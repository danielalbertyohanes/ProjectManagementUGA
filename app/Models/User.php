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
        'email',
        'password',
        'no_telp',
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

    public function logVideos()
    {
        return $this->hasMany(LogVideo::class);
    }

    public function logPpts()
    {
        return $this->hasMany(LogPpt::class);
    }
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
        return DB::table('users')->where('position_id', 2)->get();
    }

    //show user
    public static function getAll()
    {
        return User::orderBy('position_id')->get();
    }
}
