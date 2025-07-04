<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MateriController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Public Routes (Tanpa Autentikasi)
|--------------------------------------------------------------------------
*/

// Autentikasi
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Tes koneksi
Route::get('/test', function () {
    return response()->json(['message' => 'test ok']);
});

// Materi publik (GET tanpa login)
Route::get('/materi', [MateriController::class, 'index']);

// Daftar semua user (jika memang dimaksudkan untuk publik, jika tidak, pindahkan ke grup auth)
Route::get('/users', [UserController::class, 'index']);



/*
|--------------------------------------------------------------------------
| Protected Routes (Butuh Autentikasi via Sanctum)
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {

    // Ambil data user login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    /*
    |--------------------------------------------------------------------------
    | Admin-only routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')->group(function () {
        // Tambah user oleh admin
        Route::post('/users', [UserController::class, 'store']);

        // Ubah role user
        Route::put('/users/{id}/role', [UserController::class, 'changeRole']);

        // Update user (misalnya nama/email)
        Route::put('/users/{id}', [UserController::class, 'update']);
    });

    /*
    |--------------------------------------------------------------------------
    | Materi - hanya user login yang bisa menambah
    |--------------------------------------------------------------------------
    */
    Route::post('/materi', [MateriController::class, 'store']);
    Route::put('/materi/{id}', [MateriController::class, 'update']);
    Route::get('/materi/{id}', [MateriController::class, 'show']);
    Route::post('/materi/{id}', [MateriController::class, 'update']); // untuk support _method PUT
    Route::delete('/materi/{id}', [MateriController::class, 'destroy']);



    /*
    |--------------------------------------------------------------------------
    | User Management (delete user)
    |--------------------------------------------------------------------------
    */
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});
