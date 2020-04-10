<?php

namespace App\Http\Controllers;

use App\Album;
use App\Http\Requests\AlbumStoreRequest;
use App\Http\Requests\AlbumUpdateRequest;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
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
        return Album::create($request->validated());
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
     * @return bool
     */
    public function update(AlbumUpdateRequest $request, Album $album)
    {
        return $album->update($request->validated());
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
