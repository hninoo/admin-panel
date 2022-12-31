<?php

namespace App\Http\Services\Api;

use App\Http\Repositories\Api\ArtistRepository;
use Illuminate\Support\Str;

class ArtistService
{
    private $artistRepository;

    public function __construct(ArtistRepository $artistRepo)
    {
        $this->artistRepository = $artistRepo;
    }

    public function getAll($filter)
    {
        $data = $this->artistRepository->getPaginatedWithFilter($filter);
        return $data;
    }
}
