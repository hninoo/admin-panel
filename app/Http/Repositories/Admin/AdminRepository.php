<?php

namespace App\Http\Repositories\Admin;

use App\Models\Admin;
use App\Http\Repositories\BaseRepository;

class AdminRepository extends BaseRepository
{
    public function __construct(Admin $model)
    {
        $this->model = $model;
    }
}
