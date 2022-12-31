<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\Api\ArtistFilter;
use App\Http\Resources\Api\Artist as ArtistResource;
use App\Http\Resources\Api\ArtistResourceCollection;
use App\Http\Services\Api\ArtistService;
use App\Http\Utilities\HttpResponseUtility;
use Illuminate\Http\Request;

class ArtistController extends Controller
{

    private $artistService, $httpResponseUtility;

    public function __construct(ArtistService $artistService, HttpResponseUtility $httpResponseUtility)
    {
        $this->artistService = $artistService;
        $this->httpResponseUtility = $httpResponseUtility;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ArtistFilter $filter)
    {
        $data = $this->artistService->getAll($filter);
        return $this->httpResponseUtility->successResponse(new ArtistResourceCollection($data), null, config('message.successMsg'));
    }
}
