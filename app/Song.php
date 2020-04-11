<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Song extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'name',
        'artist',
        'album',
        'release',
        'duration',
        'user',
        'media',
    ];

    protected $casts = [
        'name' => 'string',
        'artist' => 'integer',
        'album' => 'integer',
        'release' => 'integer',
        'duration' => 'float',
        'user' => 'integer',
    ];

    protected $with = [
        'artist',
        'album',
        'user',
    ];

    public function artist()
    {
        $this->belongsTo(Artist::class);
    }

    public function album()
    {
        $this->belongsTo(Album::class);
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function getMediaAttribute()
    {
        $this->getMedia('song');
    }

    public function registerMediaConversions(Media $media = null) : void
    {
        $this->addMediaConversion('cover')
            ->width(400)
            ->sharpen(10);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('song_cover')
            ->onlyKeepLatest(1);

        $this->addMediaCollection('song')
            ->onlyKeepLatest(1);
    }
}
