<?php

namespace App\Http\Repositories\Api;

use App\Models\Album;

class AlbumRepository extends BaseRepository
{
    public function __construct(Album $model)
    {
        $this->model = $model;
    }
}
