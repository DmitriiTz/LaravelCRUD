<?php

namespace App\Http\Controllers;

use App\Http\Requests\SongStoreRequest;
use App\Http\Requests\SongUpdateRequest;
use App\Song;
use App\Services\CreateMusicFileService;
use App\Services\CreateCoverFileService;

class SongController extends Controller
{
    protected $create_song;
    protected $cover;

    public function __construct(CreateMusicFileService $create_song, CreateCoverFileService $cover)
    {
        $this->create_song = $create_song;
        $this->cover = $cover;
    }

    /**
     * @return Song[]
     */
    public function index()
    {
        return Song::all();
    }

    /**
     * @param SongStoreRequest $request
     * @return Song
     */
    public function store(SongStoreRequest $request)
    {
        $song = Song::create($request->validated());
        $this->create_song->make($song, $request);
        $this->cover->make($song, 'song_cover', $request);
        return $song;
    }

    /**
     * @param Song $song
     * @return Song
     */
    public function show(Song $song)
    {
        return $song;
    }

    /**
     * @param SongUpdateRequest $request
     * @param Song $song
     * @return Song
     */
    public function update(SongUpdateRequest $request, Song $song)
    {
        $song->update($request->validated());
        if ($request->hasFile('file')) {
            $this->create_song->make($song, $request);
        }
        if ($request->hasFile('cover')) {
            $this->cover->make($song, 'song_cover', $request);
        }
        return $song;
    }

    /**
     * @param Song $song
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Song $song)
    {
        return $song->delete();
    }
}
