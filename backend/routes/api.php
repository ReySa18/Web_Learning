<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\MateriController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::put('/admin/users/{id}/role', [UserController::class, 'changeRole']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/admin/users', [UserController::class, 'store']);
});


Route::get('/test', function () {
    return response()->json(['message' => 'test ok']);
});


Route::get('/materi', [MateriController::class, 'index']);
Route::post('/materi', [MateriController::class, 'store']);

Route::get('/users', [UserController::class, 'index']);

Route::middleware(['auth:sanctum'])->delete('/users/{id}', [UserController::class, 'destroy']);

Route::middleware('auth:sanctum')->put('/admin/users/{id}', [UserController::class, 'update']);

