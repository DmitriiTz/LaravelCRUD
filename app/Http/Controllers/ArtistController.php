<?php

namespace App\Http\Controllers;

use App\Artist;
use App\Http\Requests\ArtistStoreRequest;
use App\Http\Requests\ArtistUpdateRequest;
use App\Services\CreateCoverFileService;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    protected $cover;

    public function __construct(CreateCoverFileService $cover)
    {
        $this->cover = $cover;
    }

    /**
     * @return Artist[]
     */
    public function index()
    {
        return Artist::all();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(ArtistStoreRequest $request)
    {
        $artist = Artist::create($request->validated());
        $this->cover->make($artist, 'artist_cover', $request);
        return $artist;
    }

    /**
     * @param Artist $artist
     * @return Artist
     */
    public function show(Artist $artist)
    {
        return $artist;
    }

    /**
     * @param Request $request
     * @param Artist $artist
     * @return Artist
     */
    public function update(ArtistUpdateRequest $request, Artist $artist)
    {
        $artist->update($request->validated());
        if ($request->hasFile('cover')) {
            $this->cover->make($artist, 'artist_cover', $request);
        }
        return $artist;
    }

    /**
     * @param Artist $artist
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Artist $artist)
    {
        return $artist->delete();
    }
}
