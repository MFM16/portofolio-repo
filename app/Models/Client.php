<?php

namespace App\Models;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'name',
        'photo',
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
