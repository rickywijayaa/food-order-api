<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/register",[UserController::class,'register'])->name("register");
Route::post("/login",[UserController::class,'login'])->name("login");

Route::middleware(['auth'])->group(function () {
    Route::get("/users",[UserController::class,'getUser'])->name("get-user");
    Route::get("/profile",[UserController::class,'profile'])->name("profile");
    Route::post("/logout",[UserController::class,'logout'])->name("logout");
    Route::get("/refresh",[UserController::class,'refresh'])->name("refresh");
    
    Route::get("/category",[CategoryController::class,"index"])->name("get-category");
    Route::post("/create-category",[CategoryController::class,"create"])->name("create-category");
    Route::post("/update-category/{id}",[CategoryController::class,"update"])->name("update-category");
    Route::post("/delete-category/{id}",[CategoryController::class,"delete"])->name("delete-category");

    Route::get("/menu",[MenuController::class,"index"])->name("get-menu");
    Route::post('/create-menu',[MenuController::class,"create"])->name("create-menu");
});
