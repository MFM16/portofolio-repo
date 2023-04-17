<?php

namespace App\Models;

use App\Models\Profile;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['email', 'password', 'email_verified_at', 'email_verified_token', 'role'];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
