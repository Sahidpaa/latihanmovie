<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MovieController::class, 'index']);
Route::get('/movie/{id}', [MovieController::class, 'detail']);
Route::get('/movies/create', [MovieController::class, 'create']);
Route::post('/movies/store', [MovieController::class, 'store']);
Route::get('/movies/data', [MovieController::class, 'data']);
Route::get('/movies/edit/{id}', [MovieController::class, 'edit']);

Route::post('/movies/{id}/update', [MovieController::class, 'update'])->name('movies.update');
Route::get('/movies/delete/{id}', [MovieController::class, 'destroy'])->name('movies.delete');
