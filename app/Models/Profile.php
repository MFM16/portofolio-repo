<?php

namespace App\Models;

use App\Models\User;
use App\Models\Skill;
use App\Models\Post;
use App\Models\Social;
use App\Models\Portofolio;
use App\Models\Client;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'nickname',
        'biography',
        'job',
        'job_description',
        'photo',
        'logo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function socials()
    {
        return $this->hasMany(Social::class);
    }

    public function portofolios()
    {
        return $this->hasMany(Portofolio::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function setting()
    {
        return $this->hasOne(Setting::class);
    }
}
