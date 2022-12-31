<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Services\Api\AuthService;
use App\Http\Utilities\HttpResponseUtility;

use GuzzleHttp\Exception\ClientException;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class LoginController extends Controller
{
    private $authService, $httpResponseUtility;

    public function __construct(AuthService $authService, HttpResponseUtility $httpResponseUtility)
    {
        $this->authService = $authService;
        $this->httpResponseUtility = $httpResponseUtility;
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $data = $this->authService->register($request->validated());
        return $this->httpResponseUtility->successResponse($data['result'], null, $data['message']);
    }

    /**
     * login api.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        $data = $this->authService->login($request->validated());
        return $this->httpResponseUtility->successResponse($data['result'], null, $data['message']);
    }

    /**
     * Logout the admin.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        $data = $this->authService->logout();
        return $this->httpResponseUtility->successResponse($data, null, $data['message']);
    }


    // test

    /**
     * Redirect the user to the Provider authentication page.
     *
     * @param $provider
     * @return JsonResponse
     */
    public function redirectToProvider($provider)
    {
        $validated = $this->validateProvider($provider);
        // dd(Socialite::driver($provider)->stateless());
        if (!is_null($validated)) {
            return $validated;
        }

        return Socialite::driver($provider)->stateless()->redirect();
    }

    /**
     * Obtain the user information from Provider.
     *
     * @param $provider
     * @return JsonResponse
     */
    public function handleProviderCallback($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }
        try {
            $provideUser = Socialite::driver($provider)->stateless()->user();
        } catch (ClientException $exception) {
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }

        $userCreated = User::firstOrCreate(
            [
                'email' => $provideUser->getEmail()
            ],
            [
                'email_verified_at' => now(),
                'name' => $provideUser->getName(),
                'status' => true,
            ]
        );
        $userCreated->providers()->updateOrCreate(
            [
                'provider' => $provider,
                'provider_id' => $provideUser->getId(),
            ],
            [
                'avatar' => $provideUser->getAvatar()
            ]
        );
        $token = $userCreated->createToken('token-name')->plainTextToken;

        return response()->json($userCreated, 200, ['Access-Token' => $token]);
    }

    /**
     * @param $provider
     * @return JsonResponse
     */
    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['facebook', 'github', 'google'])) {
            return response()->json(['error' => 'Please login using facebook, github or google'], 422);
        }
    }
}
