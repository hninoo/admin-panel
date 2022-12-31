<?php

namespace App\Http\Repositories\Api;

use App\Models\Artist;
use Illuminate\Support\Facades\Auth;

class ArtistRepository extends BaseRepository
{
    public function __construct(Artist $model)
    {
        $this->model = $model;
    }

    public function checkExistingUser($email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function register($data)
    {
        unset($data['c_password']);
        $data['password'] = bcrypt($data['password']);
        $data['last_login'] = now();
        $user = $this->model->create($data);
        $data['token'] =  $user->createToken($user->email)->plainTextToken;
        $data['name'] =  $user->name;
        $message = config('message.success.register') . config('message.success.send-verify-email');
        $user->sendEmailVerificationNotification();
        return [
            'result' => $data,
            'message' => $message
        ];
    }

    public function login($data)
    {
        /*
        /return array
        */
        $user = Auth::user();
        $user->tokens()->delete();
        $data['token'] =  $user->createToken($data['email'])->plainTextToken;
        $data['username'] =  $user->name;
        $message = config('message.success.login');
        return [$data,  $message];
    }

    public function logout($data)
    {
    }
}
