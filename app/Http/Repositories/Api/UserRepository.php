<?php

namespace App\Http\Repositories\Api;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository
{
    protected $model;
    public function __construct(User $model)
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
        // $user->sendEmailVerificationNoti();
        return [
            'result' => $user,
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
