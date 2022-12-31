<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PasswordResetRequest;
use App\Http\Utilities\HttpResponseUtility;
use Illuminate\Support\Facades\Mail;

class PasswordResetLinkController extends Controller
{
    private $httpResponseUtility;
    public function __construct(HttpResponseUtility $httpResponseUtility)
    {
        $this->httpResponseUtility = $httpResponseUtility;
    }
    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function generateToken(PasswordResetRequest $request)
    {
        $token = password_hash($request->email . env("APP_NAME"), PASSWORD_BCRYPT, ['cost' => "10"]);

        try {
            Mail::to($request->only('email'))->send(new \App\Mail\ForgotPasswordMail($token));
        } catch (\Throwable $th) {
            return $this->httpResponseUtility->errorResponse(["data" => $token], null, config('message.error.passwords-sent'));
        }

        return $this->httpResponseUtility->successResponse("", null, config('message.success.passwords-sent'));
    }
}
