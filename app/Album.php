<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Album extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'name',
        'artist',
        'release',
    ];

    protected $casts = [
        'name' => 'string',
        'artist' => 'integer',
        'release' => 'integer',
    ];

    public function songs()
    {
        $this->hasMany(Song::class);
    }

    public function registerMediaConversions(Media $media = null) : void
    {
        $this->addMediaConversion('cover')
            ->width(400)
            ->sharpen(10);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('album_cover')
            ->onlyKeepLatest(1);
    }
}
