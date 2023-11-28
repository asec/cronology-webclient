<?php

use App\Http\Controllers\User as UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
})->name("home");

Route::get("/api-status", function () {
    return view("api-status");
})->name("api.status");

Route::middleware("guest")->group(function () {
    Route::get("/register", [UserController::class, "register"])->name("user.register");

    Route::get("/login", [UserController::class, "login"])->name("user.login");

    Route::get("/forgot-password", [UserController::class, "forgotPassword"])->name("user.forgot-password");

    Route::get("/reset-password/{token}", [UserController::class, "resetPassword"])->name("user.reset-password");
});

Route::middleware("auth")->group(function () {
    Route::get("/logout", [UserController::class, "logout"])->name("user.logout");

    Route::get("/profile", [UserController::class, "profile"])->name("user.profile");
});

if (env("APP_ENV") === "local")
{
    Route::get("/test/formstates", function () {
        return view("test.formstates");
    })->name("test.formstates");

    Route::get("/phpinfo", function () {
        //dd(openssl_get_cert_locations());
        phpinfo();
    });
}
