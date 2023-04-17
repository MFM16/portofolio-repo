<?php

namespace App\Models;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_id',
        'language',
        'client',
        'blog'
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
