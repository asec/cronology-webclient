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

Route::middleware("guest")->group(function () {
    Route::get("/register", [UserController::class, "register"])->name("user.register");

    Route::get("/login", [UserController::class, "login"])->name("user.login");
});

Route::middleware("auth")->group(function () {
    Route::get("/logout", [UserController::class, "logout"])->name("user.logout");
});

if (env("APP_ENV") === "local")
{
    Route::get("/test/formstates", function () {
        return view("test.formstates");
    })->name("test.formstates");
}
