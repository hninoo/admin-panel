<?php

namespace App\Http\Services\Api;

use App\Http\Repositories\Api\AlbumRepository;
use App\Http\Repositories\Api\ArtistRepository;

class AlbumService
{
    private $albumRepository;

    public function __construct(AlbumRepository $albumRepo)
    {
        $this->albumRepository = $albumRepo;
    }

    public function getAll($filter)
    {
        $data = $this->albumRepository->getPaginatedWithFilter($filter);
        return $data;
    }
}
