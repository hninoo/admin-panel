<?php

namespace App\Http\Repositories\Admin;

use App\Http\Repositories\BaseRepository;
use App\Models\User;

class UserRepository extends BaseRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
