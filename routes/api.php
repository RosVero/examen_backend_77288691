<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PrestamoController;

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

Route::get('/autores', [AutorController::class,'index']); //muestra todos los registros
Route::get('/autores/{id}', [AutorController::class,'edit']); //devuelve un registro
Route::post('/autores', [AutorController::class,'store']); // crea un registro
Route::put('/autores/{id}', [AutorController::class,'update']); // actualiza un registro
Route::delete('/autores/{id}', [AutorController::class,'destroy']); //elimina un registro

Route::get('/libros', [LibroController::class,'index']); //muestra todos los registros
Route::get('/libros/{id}', [LibroController::class,'edit']); //devuelve un registro
Route::post('/libros', [LibroController::class,'store']); // crea un registro
Route::put('/libros/{id}', [LibroController::class,'update']); // actualiza un registro
Route::delete('/libros/{id}', [LibroController::class,'destroy']); //elimina un registro

Route::get('/clientes', [ClienteController::class,'index']); //muestra todos los registros
Route::get('/clientes/{id}', [ClienteController::class,'edit']); //devuelve un registro
Route::post('/clientes', [ClienteController::class,'store']); // crea un registro
Route::put('/clientes/{id}', [ClienteController::class,'update']); // actualiza un registro
Route::delete('/clientes/{id}', [ClienteController::class,'destroy']); //elimina un registro

Route::get('/prestamos', [PrestamoController::class,'index']); //muestra todos los registros
Route::get('/prestamos/{id}', [PrestamoController::class,'edit']); //devuelve un registro
Route::post('/prestamos', [PrestamoController::class,'store']); // crea un registro
Route::put('/prestamos/{id}', [PrestamoController::class,'update']); // actualiza un registro
Route::delete('/prestamos/{id}', [PrestamoController::class,'destroy']); //elimina un registro

#otros
Route::get('/libros_autor', [LibroController::class,'libros_autor']); //devuelve el listado de libros y su autor
Route::get('/prestamos_libro_autor', [PrestamoController::class,'prestamos_libro_autor']); //muestra los registros de prestamos con clientes y libros de manera literal
Route::get('/libros_vencidos', [PrestamoController::class,'libros_vencidos']); //muestra los registros del reporte1
Route::get('/libros_sin_prestamo', [LibroController::class,'libros_sin_prestamo']); //muestra los registros del reporte1

Route::post('/prestamos_rango', [PrestamoController::class,'prestamos_rango']); //muestra los prestamos entre un rango de fechas (reporte 2);

