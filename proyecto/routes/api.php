<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TurnoController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::post('/registro', [AuthController::class, 'registrar']);
Route::post('/login', [AuthController::class, 'iniciarSesion']);
Route::post('/turno', [TurnoController::class, 'solicitarTurno']);
Route::get('/productos', [ProductoController::class, 'catalogo']);

