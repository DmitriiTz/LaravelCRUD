<?php


namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class CreateCoverFileService
{
    public function make(Model $model, string $collection, $request)
    {
        return $model->addMediaFromRequest('cover')->toMediaCollection($collection);
    }
}