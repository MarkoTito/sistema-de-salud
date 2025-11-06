<?php

use App\Http\Controllers\AsistenteController;
use App\Http\Controllers\CampañasController;
use App\Http\Controllers\ConfiguaracionController;
use App\Http\Controllers\TipoCampañaController;
use Illuminate\Support\Facades\Route;

Route::get('/',function(){
    return view('admin.dashboard');
})->name('dashboard');

//ruta de la campañas
Route::resource('Campañas',CampañasController::class);

Route::resource('Asitentes',AsistenteController::class);
Route::post('Asitentes/{asitente}/edit2',[AsistenteController::class,'edit2'])->name('Asitentes.edit2');

Route::resource('Configuracion',ConfiguaracionController::class);

Route::resource('Tipocampaña',TipoCampañaController::class);
Route::post('tipos/{campaña}/dropzone',[TipoCampañaController::class,'dropzone'])->name('campaña.dropzone');

