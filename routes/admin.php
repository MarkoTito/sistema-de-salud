<?php

use App\Http\Controllers\AsistenteController;
use App\Http\Controllers\CampañasController;
use App\Http\Controllers\CharlasController;
use App\Http\Controllers\ConfiguaracionController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\TipoCampañaController;
use Illuminate\Support\Facades\Route;

// rutas protegidas (con auth)
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('Campañas', CampañasController::class);
    Route::resource('Asitentes', AsistenteController::class);
    Route::post('Asitentes/{asitente}/edit2', [AsistenteController::class, 'edit2'])->name('Asitentes.edit2');
    Route::post('Asitentes/look', [AsistenteController::class, 'look'])->name('Asitentes.look');
    Route::resource('Configuracion', ConfiguaracionController::class);
    Route::resource('Tipocampaña', TipoCampañaController::class);
    Route::post('tipos/{campaña}/dropzone', [TipoCampañaController::class, 'dropzone'])->name('campaña.dropzone');
    Route::resource('Charlas', CharlasController::class);
    Route::get('Charlas/{charla}/download', [CharlasController::class, 'downloadOne'])->name('charla.downloadOne');
    Route::get('Charlas/{charla}/documento', [CharlasController::class, 'documento'])->name('charla.documento');
    Route::post('Charlas/download', [CharlasController::class, 'downloadFound'])->name('charla.downloadFound');
    Route::get('Charlas/encontrado/excel',[CharlasController::class,'dowloadExport'])->name('export.excell');
    Route::post('Charlas/{charla}/dropzone', [TipoCampañaController::class, 'dropzone'])->name('charla.dropzone');
    // ruta de generar link (solo admin)
    Route::get('/generar-link', [FormularioController::class, 'generarLink'])->name('formulario.generar');
});

// rutas públicas (sin auth)
Route::middleware([])->group(function () {
    Route::get('/formulario/{token}', [FormularioController::class, 'mostrar'])->name('formulario.mostrar');
    Route::post('/formulario/guardar', [FormularioController::class, 'guardar'])->name('formulario.guardar');
});