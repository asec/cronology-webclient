<?php

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

Route::get("/register", function () {
    return view("register");
})->name("user.register");

if (env("APP_ENV") === "local")
{
    Route::get("/register-formstates", function () {
        return view("register-test-formstates");
    })->name("user.register-formstates");
}
