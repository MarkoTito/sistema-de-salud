<?php

use App\Http\Controllers\AsistenteController;
use App\Http\Controllers\CampañasController;
use Illuminate\Support\Facades\Route;

Route::get('/',function(){
    return view('admin.dashboard');
})->name('dashboard');

//ruta de la campañas
Route::resource('Campañas',CampañasController::class);
Route::get('/editar/{id}',[CampañasController::class,'editar']);



Route::resource('Asitentes',AsistenteController::class);
Route::post('Asitentes/eliminar',[AsistenteController::class,'eliminar'])->name('Asitentes.eliminar');
