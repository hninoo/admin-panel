<?php

namespace App\Http\Services\Admin;

class BannerAlbumService
{
    private $userRepo;

    public function __construct()
    {
        $this->itemPerPage = config('enums.itemPerPage');
    }
}
