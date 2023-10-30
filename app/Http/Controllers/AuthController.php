<?php

namespace App\Http\Controllers;

use App\Contracts\UserContract;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\MessageResource;
use App\Http\Resources\UserResource;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
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
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function register(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('auth.signup');

    }

    /**
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function login(): \Illuminate\Foundation\Application|View|Factory|Application
    {
        return view('auth.signin');
    }


    /**
     * @param RegisterRequest $request
     * @return RedirectResponse
     */
    public function doRegister(RegisterRequest $request): RedirectResponse
    {
        $user =
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'password' => Hash::make($request->password),
                'email' => $request->email,
            ];
        $this->userContract->store($user);
        return redirect()->route('auth.register');
    }


    /**
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function doLogin(LoginRequest $request): RedirectResponse
    {
        $inputs = $request->all();

        if (Auth::attempt([
            'email' => $inputs['email'],
            'password' => $inputs['password'],
        ])) {
            return redirect()->route('blogs.index');
        }
        return redirect()->route('auth.register');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function signOut(Request $request): RedirectResponse
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }
}
