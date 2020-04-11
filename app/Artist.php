<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Artist extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia;

    protected $fillable = [
        'name',
        'born',
    ];

    protected $casts = [
        'name' => 'string',
        'born' => 'integer',
    ];

    public function songs()
    {
        $this->hasMany(Song::class);
    }

    public function albums()
    {
        $this->hasMany(Album::class);
    }

    public function registerMediaConversions(Media $media = null) : void
    {
        $this->addMediaConversion('cover')
            ->width(400)
            ->sharpen(10);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('artist_cover')
            ->onlyKeepLatest(1);
    }
}
