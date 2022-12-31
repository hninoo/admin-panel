<?php

namespace App\Http\Services\Admin;

class SongService
{
    private $userRepo;

    public function __construct()
    {
        $this->itemPerPage = config('enums.itemPerPage');
    }
}
