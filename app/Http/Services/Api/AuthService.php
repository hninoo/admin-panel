<?php

namespace App\Http\Services\Api;

use App\Http\Repositories\Api\UserRepository;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    private $userRepository;
    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    public function register($data)
    {
        return $this->userRepository->register($data);
    }

    public function login($request)
    {
        $user = $this->userRepository->checkExistingUser($request['email']);

        $data = [];

        if (!$user) {
            $message = config('message.error.not-registered');
        } elseif (!Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            $message = config('message.error.acc-login-fail');
        } else {
            [$data, $message] = $this->userRepository->login($request);
        }

        return [
            'result' => $data,
            'message' => $message
        ];
    }

    public function logout()
    {
        $user = Auth::user();
        $user->tokens()->delete();
        return [
            'result' => '',
            'message' => config('message.success.logout')
        ];
    }

    public function deleteUser($user)
    {
        $user->tokens()->delete();
        return $this->userRepository->delete($user->id);
    }


    public function updatePassword($data)
    {
        $hashedToken = password_hash($data['email'] . env("APP_NAME"), PASSWORD_BCRYPT, ['cost' => "10"]);

        if (Hash::check($data['email'] . env("APP_NAME"), $hashedToken)) {
            $user = $this->userRepository->checkExistingUser($data['email']);
            $data = [
                'password' => bcrypt($data['password']),
                'remember_token' => Str::random(60),
            ];
            $this->userRepository->update($data, $user->id);

            return true;
        }
        return false;
    }
}
