<?php

use App\Http\Controllers\EstoqueController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EstoqueController::class, 'home_index']);
Route::get('/estoque', [EstoqueController::class, 'estoque_index']);

Route::post('/item/create', [EstoqueController::class, 'itemCreate']);
Route::post('/item/update/{id}', [EstoqueController::class, 'itemUpdate']);
Route::post('/item/delete/{id}', [EstoqueController::class, 'itemDelete']);
