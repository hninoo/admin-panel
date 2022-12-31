<?php

namespace App\Http\Services\Admin;

class BannerSongService
{
    private $userRepo;

    public function __construct()
    {
        $this->itemPerPage = config('enums.itemPerPage');
    }
}
