<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\SliderController;
use App\Http\Controllers\Backend\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/slider/list',[SliderController::class,'sliderList']);



/*******Backend Api*******/
Route::post('/login',[UserController::class,'login']);



Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout',[UserController::class,'logout']);
    Route::post('/user',[UserController::class,'getUser']);
    Route::post('/user/list',[UserController::class,'userList']);
    Route::post('/user/create',[UserController::class,'store']);
    Route::get('/user/edit/{id}',[UserController::class,'edit']);
    Route::post('/user/update',[UserController::class,'update']);
    Route::post('/user/delete',[UserController::class,'destroy']);

    //Services Routes
    Route::apiResource('/services',\App\Http\Controllers\Backend\ServiceController::class);
});
