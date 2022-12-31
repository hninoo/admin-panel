<?php

namespace App\Http\Repositories\Admin;

use App\Http\Repositories\BaseRepository;
use App\Models\BannerAlbum;

class BannerAlbumRepository extends BaseRepository
{
    public function __construct(BannerAlbum $model)
    {
        $this->model = $model;
    }
}
