<?php

use App\Http\Controllers\AsistenteController;
use App\Http\Controllers\CampañasController;
use App\Http\Controllers\ConfiguaracionController;
use Illuminate\Support\Facades\Route;

Route::get('/',function(){
    return view('admin.dashboard');
})->name('dashboard');

//ruta de la campañas
Route::resource('Campañas',CampañasController::class);

Route::resource('Asitentes',AsistenteController::class);

Route::resource('Configuracion',ConfiguaracionController::class);

