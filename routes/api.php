<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
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
    Route::get("/category/{id}",[CategoryController::class,"getCategoryById"])->name("get-category-by-id");
    Route::post("/update-category/{id}",[CategoryController::class,"update"])->name("update-category");
    Route::post("/delete-category/{id}",[CategoryController::class,"delete"])->name("delete-category");

    Route::get("/menu",[MenuController::class,"index"])->name("get-menu");
    Route::get("/menu/{id}",[MenuController::class,"getMenuById"])->name("get-menu-by-id");
    Route::post('/create-menu',[MenuController::class,"create"])->name("create-menu");
    Route::post('/update-menu/{id}',[MenuController::class,"update"])->name("update-menu");
    Route::post("/delete-menu/{id}",[MenuController::class,"delete"])->name("delete-menu");

    Route::get("/order",[OrderController::class,"index"])->name("get-order");
    Route::get("/order/{id}",[OrderController::class,"getOrderById"])->name("get-order-by-id");
    Route::post("/create-order",[OrderController::class,"create"])->name("create-order");
    Route::get("/filter-month",[OrderController::class,"filterOrderByMonth"])->name("filter-order-by-month");
    Route::get("/filter-week",[OrderController::class,"filterOrderByWeek"])->name("filter-order-by-week");
    Route::get("/recent-order",[OrderController::class,"getRecentOrder"])->name("get-recent-order");
});
