<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
use App\Http\Controllers\StudentController;

Route::get('/students', [StudentController::class, 'index']);

Route::put('/students/{id}', [StudentController::class, 'update']);

Route::delete('/students/{id}', [StudentController::class, 'destroy']);
Route::get('/students/{nisn}', [StudentController::class, 'check']);

Route::post('/login', [StudentController::class, 'login']);

Route::post('/students', [StudentController::class, 'store']);

Route::post('/ai', [StudentController::class, 'ai']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


