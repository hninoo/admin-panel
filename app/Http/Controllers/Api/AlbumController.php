<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\Api\AlbumFilter;
use App\Http\Resources\Api\AlbumResource;
use App\Http\Services\Api\AlbumService;
use App\Http\Utilities\HttpResponseUtility;

class AlbumController extends Controller
{

    private $albumService, $httpResponseUtility;

    public function __construct(AlbumService $albumService, HttpResponseUtility $httpResponseUtility)
    {
        $this->albumService = $albumService;
        $this->httpResponseUtility = $httpResponseUtility;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AlbumFilter $filter)
    {
        $data = $this->albumService->getAll($filter);
        return $this->httpResponseUtility->successResponse(AlbumResource::collection($data), null, config('message.successMsg'));
    }
}
