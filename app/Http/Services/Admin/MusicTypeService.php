<?php

namespace App\Http\Services\Admin;

class MusicTypeService
{
    private $userRepo;

    public function __construct()
    {
        $this->itemPerPage = config('enums.itemPerPage');
    }
}
