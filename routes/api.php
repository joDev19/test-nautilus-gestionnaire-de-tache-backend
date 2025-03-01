<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post("login", [UserController::class, 'login']);
Route::get("logout", [UserController::class, 'logout']);
Route::post("register", [UserController::class, 'register']);
Route::apiResource('tasks', TaskController::class)->middleware('auth:sanctum');
Route::put('change-status-of-task/{id}/{status}', [TaskController::class, 'changeStatus'])->middleware('auth:sanctum');
