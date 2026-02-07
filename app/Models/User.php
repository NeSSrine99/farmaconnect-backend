<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Roles constants
    const ROLE_CLIENT = 'client';
    const ROLE_ADMIN = 'admin';
    const ROLE_PHARMACIEN = 'pharmacien';

    protected $fillable = [
        'clerk_id',
        'email',
        'name',
        'role',
    ];

    public static function roles()
    {
        return [
            self::ROLE_CLIENT,
            self::ROLE_ADMIN,
            self::ROLE_PHARMACIEN,
        ];
    }

    /* =====================
       Relationships
    ====================== */

    // User ❤️ Products (Favorites)
    public function favorites()
    {
        return $this->belongsToMany(Product::class, 'favorites')
                    ->withTimestamps();
    }
}
