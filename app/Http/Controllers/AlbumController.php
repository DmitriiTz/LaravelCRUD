<?php

namespace App\Http\Controllers;

use App\Album;
use App\Http\Requests\AlbumStoreRequest;
use App\Http\Requests\AlbumUpdateRequest;
use App\Services\CreateCoverFileService;

class AlbumController extends Controller
{
    protected $cover;

    public function __construct(CreateCoverFileService $cover)
    {
        $this->cover = $cover;
    }

    /**
     * @return Album[]|\Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Album::all();
    }

    /**
     * @param AlbumStoreRequest $request
     * @return mixed
     */
    public function store(AlbumStoreRequest $request)
    {
        $album = Album::create($request->validated());
        $this->cover->make($album, 'album_cover', $request);
        return $album;
    }

    /**
     * @param Album $album
     * @return Album
     */
    public function show(Album $album)
    {
        return $album;
    }

    /**
     * @param AlbumUpdateRequest $request
     * @param Album $album
     * @return Album
     */
    public function update(AlbumUpdateRequest $request, Album $album)
    {
        $album->update($request->validated());
        if ($request->hasFile('cover')) {
            $this->cover->make($album, 'album_cover', $request);
        }
        return $album;
    }

    /**
     * @param Album $album
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Album $album)
    {
        return $album->delete();
    }
}
