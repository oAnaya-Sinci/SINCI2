<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Office;
use App\Models\Position;
use App\Models\Department;

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
        'email',
        'email_notifi',
        'telegram_notifi',
        'chat_id',
        'admission_date',
        'password',
        'is_admin',
        'reports',
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
    ];

    public function offices()
    {
        return $this->belongsToMany(Office::class);
    }

    public function positions()
    {
        return $this->belongsToMany(Position::class);
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }
}
