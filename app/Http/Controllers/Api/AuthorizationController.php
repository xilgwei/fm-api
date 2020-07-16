<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthorizationController extends Controller
{
    public function store(UserRequest $request)
    {
        $user = User::query()->create([
            'mobile' => $request->get('mobile'),
            'user_pass' => encryption_password($request->get('password')),
            'update_time' => Carbon::now()
        ]);

        $token = Auth::guard('api')->login($user);

        return $this->respondWithToken($token);
    }

    public function login(UserRequest $request)
    {
        $user = User::query()->where(['mobile' => $request->get('mobile'), 'user_pass' => encryption_password($request->get('password'))])->first();
        $token = Auth::guard('api')->login($user);
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return $this->response->array([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60
        ]);
    }

    public function refreshToken()
    {

    }
}
