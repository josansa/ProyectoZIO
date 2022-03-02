<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::put('usuarios/edit/{id}', [UserController::class, "update"])->name("usuarios.edit");
Route::put('usuarios/edit/profileimg/{id}', [UserController::class, "updateProfileImg"])->name("usuarios.edit.profileimg.update");
Route::get('usuarios/edit/{id}', [UserController::class, "edit"])->name("usuarios.edit");
Route::get('usuarios/registro', [UserController::class, "create"])->name("registro");
Route::post('usuarios/registrarUsuario', [UserController::class, "store"])->name("registrarUsuario");
Route::post('image/add', [ImageController::class, "store"])->name("image.add");
Route::delete('image/remove/{id}', [ImageController::class, "destroy"])->name("image.remove.delete");
Route::post('usuarios/iniciarSesion', [UserController::class, "iniciarSesion"])->name("iniciarSesion");
Route::post('usuarios/cerrarSesion', [UserController::class, "cerrarSesion"])->name("cerrarSesion");
Route::get('galeria/home/{name}', [UserController::class, "show"])->name("galeria");
Route::get('/', [HomeController::class, "index"])->name("index");
