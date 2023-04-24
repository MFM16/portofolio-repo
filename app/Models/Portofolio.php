<?php

namespace App\Models;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Portofolio extends Model implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;

    protected $fillable = [
        'profile_id',
        'name',
        'description',
        'full_description',
        'slug',
        'thumbnail'
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('image-content')
              ->width(500);
    }
}
