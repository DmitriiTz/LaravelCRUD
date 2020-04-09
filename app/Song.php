<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Song extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'artist',
        'album',
        'release',
        'duration',
        'user',
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
}
