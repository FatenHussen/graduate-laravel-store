<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\FileTrait;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, FileTrait;
    protected $tabel = 'users';
    protected $fillable = [
        'name',
        'email',
        // 'city_id',
        'password',
        'image',
        'gender',
        'phone_nimber',
        'email_verified_at',
        'is_blocked',

    ];

    protected $hidden = [
        'remember_token',
        'password',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_premium' => 'boolean',
        'is_blocked' => 'boolean',
    ];

    public function verifications(): HasMany
    {
        return $this->hasMany(Verification::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
     // Define the relationship with Cart
     public function cart()
     {
         return $this->hasOne(Cart::class);
     }
 
     // Define the relationship with Order
     public function orders()
     {
         return $this->hasMany(Order::class);
     }
}