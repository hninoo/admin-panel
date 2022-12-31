<?php

namespace App\Http\Services\Admin;

use App\Http\Repositories\Admin\ComposerRepository;

class ComposerService
{
    private $composerRepo;

    public function __construct(ComposerRepository $composerRepo)
    {
        $this->itemPerPage = config('enums.itemPerPage');
        $this->composerRepo = $composerRepo;
    }

    public function getAll($filter)
    {
        $this->composerRepo->getPaginatedWithFilter($this->itemPerPage, $filter);
    }
}
