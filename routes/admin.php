<?php

use App\Http\Controllers\AsistenteController;
use App\Http\Controllers\CampañasController;
use App\Http\Controllers\CharlasController;
use App\Http\Controllers\ConfiguaracionController;
use App\Http\Controllers\TipoCampañaController;
use Illuminate\Support\Facades\Route;

Route::get('/',function(){
    return view('admin.dashboard');
})->name('dashboard');

//ruta de la campañas
Route::resource('Campañas',CampañasController::class);


//RUTAS DEL ASITENTES
Route::resource('Asitentes',AsistenteController::class);
Route::post('Asitentes/{asitente}/edit2',[AsistenteController::class,'edit2'])->name('Asitentes.edit2');
//buscar asistente  
Route::post('Asitentes/look',[AsistenteController::class,'look'])->name('Asitentes.look');
// asistente  encontrado


//RUTAS DE LA CONFIGUARION
Route::resource('Configuracion',ConfiguaracionController::class);
//RUTAS DE TIPO CAMPAÑA
Route::resource('Tipocampaña',TipoCampañaController::class);
Route::post('tipos/{campaña}/dropzone',[TipoCampañaController::class,'dropzone'])->name('campaña.dropzone');


//RUTAS DE CHARLAS
Route::resource('Charlas',CharlasController::class);