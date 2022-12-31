<?php

namespace App\Http\Repositories\Admin;

use App\Http\Repositories\BaseRepository;
use App\Models\MusicType;

class MusicTypeRepository extends BaseRepository
{
    public function __construct(MusicType $model)
    {
        $this->model = $model;
    }
}
