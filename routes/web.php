<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route Hooks - Do not delete//
	Route::view('jornadas', 'livewire.jornadas.index')->middleware('auth','can:modulo-jornadas');
	Route::view('pronosticos', 'livewire.pronosticos.index')->middleware('auth','can:modulo-pronosticos');
	Route::view('jugadores', 'livewire.jugadores.index')->middleware('auth','can:modulo-jugadores');
	Route::view('resultados', 'livewire.resultados.index')->middleware('auth','can:modulo-resultados');
	Route::view('partidos', 'livewire.partidos.index')->middleware('auth','can:modulo-partidos');
	Route::view('equipos', 'livewire.equipos.index')->middleware('auth','can:modulo-equipos');
	Route::view('perfil', 'livewire.perfils.index')->middleware('auth','can:modulo-perfil');
	Route::view('posiciones', 'livewire.posiciones.index')->middleware('auth');
	Route::view('allpronosticos', 'livewire.allpronosticos.index')->middleware('auth');
	Route::view('reglamento', 'livewire.reglamento.index')->middleware('auth');
	Route::view('password', 'livewire.cambiarpassword.index')->middleware('auth');



