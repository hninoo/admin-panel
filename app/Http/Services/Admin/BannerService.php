<?php

namespace App\Http\Services\Admin;

class BannerService
{
    private $userRepo;

    public function __construct()
    {
        $this->itemPerPage = config('enums.itemPerPage');
    }
}
