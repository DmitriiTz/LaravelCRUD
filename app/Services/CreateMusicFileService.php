<?php


namespace App\Services;

use App\Song;

class CreateMusicFileService
{
    public function make(Song $song, $request)
    {
        return $song->addMediaFromRequest('file')->toMediaCollection('song');
    }
}