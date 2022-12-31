<?php

namespace App\Http\Services\Admin;

class ArtistService
{
    private $userRepo;

    public function __construct()
    {
        $this->itemPerPage = config('enums.itemPerPage');
    }
}
