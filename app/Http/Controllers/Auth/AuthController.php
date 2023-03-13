<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Request\LoginRequest;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    /**
     * Show specified view.
     *
     * @param Request $request
     * @return Response
     */
    public function loginView()
    {
        return view('login.main', [
            'layout' => 'login'
        ]);
    }

    /**
     * Authenticate login user.
     *
     * @param Request $request
     * @return Response
     */
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            throw new Exception('Wrong email or password.');
        }
    }

    /**
     * Logout user.
     *
     * @param Request $request
     * @return Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
