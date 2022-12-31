<?php

namespace App\Http\Repositories\Admin;

use App\Http\Repositories\BaseRepository;
use App\Models\Song;

class SongRepository extends BaseRepository
{
    public function __construct(Song $model)
    {
        $this->model = $model;
    }
}
