<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\EventoController;
Route::get('/', [EventoController::class,'index']);
Route::get('/eventos/criar', [EventoController::class,'criar'])->middleware('auth');
Route::post('eventos', [EventoController::class,'store']);
Route::get('/eventos/{id}', [EventoController::class,'show']);
Route::get('/dashboard', [EventoController::class,'dashboard'])->middleware('auth');
Route::delete('/eventos/{id}', [EventoController::class,'destroy'])->middleware('auth');
Route::get('/eventos/editar/{id}', [EventoController::class,'editar'])->middleware('auth');
Route::put('/eventos/atualizar/{id}', [EventoController::class,'atualizar'])->middleware('auth');
Route::post('/eventos/join/{id}', [EventoController::class,'joinEvento'])->middleware('auth');
Route::delete('/eventos/leave/{id}', [EventoController::class,'leaveEvento'])->middleware('auth');
