<?php

namespace App\Http\Repositories\Admin;

use App\Http\Repositories\BaseRepository;
use App\Models\BannerSong;

class BannerSongRepository extends BaseRepository
{
    public function __construct(BannerSong $model)
    {
        $this->model = $model;
    }
}
