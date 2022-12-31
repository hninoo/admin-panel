<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\EmailVerificationRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     *
     * @param  \Illuminate\Foundation\Auth\EmailVerificationRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function __invoke(EmailVerificationRequest $request)
    {
        $user = User::find($request->route('id'));
        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(
                config('app.url') . RouteServiceProvider::HOME . '?verified=1'
            );
        }
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->intended(
            config('app.url') . RouteServiceProvider::HOME . '?verified=1'
        );
    }
}
