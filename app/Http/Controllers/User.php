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
}
