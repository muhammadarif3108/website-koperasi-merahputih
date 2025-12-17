<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
        'role',
        'saldo_simpanan'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
       
    ];

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function surat()
    {
        return $this->hasMany(Surat::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function simpanan()
    {
        return $this->hasMany(Simpanan::class);
    }
}
