<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use SoftDeletes;

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
}
