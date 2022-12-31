<?php

namespace App\Http\Repositories\Admin;

use App\Http\Repositories\BaseRepository;
use App\Models\Composer;

class ComposerRepository extends BaseRepository
{
    public function __construct(Composer $model)
    {
        $this->model = $model;
    }
}
