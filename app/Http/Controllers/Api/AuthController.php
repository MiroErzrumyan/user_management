<?php

namespace App\Http\Controllers\Api;

use App\Contracts\UserContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\MessageResource;
use App\Http\Resources\UserResource;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @var UserContract
     */
    protected UserContract $userContract;

    /**
     * @param UserContract $userContract
     */
    public function __construct(UserContract $userContract)
    {
        $this->userContract = $userContract;

    }

    /**
     * @param RegisterRequest $request
     * @return MessageResource
     */
    public function doRegister(RegisterRequest $request): MessageResource
    {
        $user =
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'password' => Hash::make($request->password),
                'email' => $request->email,
            ];
        $this->userContract->store($user);
        return new MessageResource(['success' => 1]);
;
    }


    /**
     * @param LoginRequest $request
     * @return MessageResource
     */
    public function doLogin(LoginRequest $request): UserResource|MessageResource
    {
        $inputs = $request->all();

        if (Auth::attempt([
            'email' => $inputs['email'],
            'password' => $inputs['password'],
        ])) {
            $accessToken = Auth::user()->createToken('authToken')->accessToken;
            return new UserResource(['success' => 1, 'user' => Auth::user(), 'accessToken' => $accessToken]);
        }
        return new MessageResource(['success' => 0]);
    }
}
