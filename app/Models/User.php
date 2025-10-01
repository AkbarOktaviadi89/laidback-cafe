<?php

// app/Models/User.php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isOwner()
    {
        return $this->role === 'owner';
    }

    public function isCashier()
    {
        return $this->role === 'cashier';
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'cashier_id');
    }
}
