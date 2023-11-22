<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class User extends Controller
{
    public function register(): View
    {
        return view("user.register");
    }

    public function login(): View
    {
        return view("user.login");
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();
        Session::invalidate();
        Session::regenerate();

        return redirect(RouteServiceProvider::HOME);
    }

    public function forgotPassword(): View
    {
        return view("user.forgot-password");
    }

    public function resetPassword(string $token): View
    {
        return view("user.reset-password", [
            "token" => $token
        ]);
    }

    public function profile(Request $request)
    {
        return view("user.profile", [
            "user" => $request->user()
        ]);
    }
}
