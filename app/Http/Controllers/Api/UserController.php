<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\Api\ArtistService;
use App\Http\Utilities\HttpResponseUtility;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $artistService, $httpResponseUtility;

    public function __construct(ArtistService $artistService, HttpResponseUtility $httpResponseUtility)
    {
        $this->artistService = $artistService;
        $this->httpResponseUtility = $httpResponseUtility;
    }

    public function profile()
    {
        return $this->httpResponseUtility->successResponse(auth()->user(), 200, config('message.successMsg'));
    }
}
