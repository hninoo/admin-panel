<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\NewPasswordRequest;
use App\Http\Services\Api\AuthService;
use App\Http\Utilities\HttpResponseUtility;

class NewPasswordController extends Controller
{
    private $authService, $httpResponseUtility;

    public function __construct(AuthService $authService, HttpResponseUtility $httpResponseUtility)
    {
        $this->authService = $authService;
        $this->httpResponseUtility = $httpResponseUtility;
    }


    /**
     * Handle an incoming new password request.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(NewPasswordRequest $request)
    {
        $data = $request->validated();

        $result = $this->authService->updatePassword($data);

        if ($result) {
            return $this->httpResponseUtility->successResponse("", null, config('message.success.passwords-reset'));
        }

        return $this->httpResponseUtility->errorResponse("", null, config('message.error.passwords-reset'));
    }
}
