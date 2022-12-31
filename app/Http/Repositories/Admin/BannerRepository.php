<?php

namespace App\Http\Repositories\Admin;

use App\Http\Repositories\BaseRepository;
use App\Models\Banner;

class BannerRepository extends BaseRepository
{
    public function __construct(Banner $model)
    {
        $this->model = $model;
    }
}
