<?php

namespace App\Http\Repositories\Admin;

use App\Http\Repositories\BaseRepository;
use App\Models\Album;

class AlbumRepository extends BaseRepository
{
    public function __construct(Album $model)
    {
        $this->model = $model;
    }
}
