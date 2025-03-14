<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role', 'division_id'];

    protected $hidden = ['password', 'remember_token'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class, 'created_by');
    }

    public function report()
    {
        return $this->hasMany(Report::class, 'created_by');
    }

    public function isCultureAgent()
    {
        return $this->role === 'culture_agent';
    }

    public function isDivisionHead()
    {
        return $this->role === 'division_head';
    }

    public function isAdminHC()
    {
        return $this->role === 'admin_hc';
    }
}
