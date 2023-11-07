<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'avatar',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (User $user) {
            $hash = md5($user->email);
            $user->avatar = 'https://www.gravatar.com/avatar/' . $hash . '?d=identicon&s=100';
        });

        static::updating(function (User $user) {
            if ($user->isDirty('email')) {
                $hash = md5($user->email);
                $user->avatar = 'https://www.gravatar.com/avatar/' . $hash . '?d=identicon&s=100';
            }
        });
    }
}
