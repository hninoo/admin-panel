<?php

namespace App\Http\Services\Admin;

class AlbumService
{
    private $userRepo;

    public function __construct()
    {
        $this->itemPerPage = config('enums.itemPerPage');
    }
}
