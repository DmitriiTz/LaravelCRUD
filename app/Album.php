<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use SoftDeletes;

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
}
