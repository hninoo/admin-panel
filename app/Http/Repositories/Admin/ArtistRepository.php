<?php

namespace App\Http\Repositories\Admin;

use App\Http\Repositories\BaseRepository;
use App\Models\Artist;

class ArtistRepository extends BaseRepository
{
    public function __construct(Artist $model)
    {
        $this->model = $model;
    }
}
