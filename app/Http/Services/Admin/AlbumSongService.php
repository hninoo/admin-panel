<?php

namespace App\Http\Services\Admin;

class AlbumSongService
{
    private $userRepo;

    public function __construct()
    {
        $this->itemPerPage = config('enums.itemPerPage');
    }
}
