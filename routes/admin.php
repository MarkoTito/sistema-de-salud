<?php

use App\Http\Controllers\AsistenteController;
use App\Http\Controllers\CampañasController;
use App\Http\Controllers\CharlasController;
use App\Http\Controllers\ConfiguaracionController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\MascotasController;
use App\Http\Controllers\TipoCampañaController;
use Illuminate\Support\Facades\Route;

// rutas protegidas (con auth)
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('Campañas', CampañasController::class);
    #asistentes
    Route::resource('Asitentes', AsistenteController::class);
    Route::post('Asitentes/{asitente}/edit2', [AsistenteController::class, 'edit2'])->name('Asitentes.edit2');
    Route::post('Asitentes/look', [AsistenteController::class, 'look'])->name('Asitentes.look');
    #configuaracion
    Route::resource('Configuracion', ConfiguaracionController::class);
    #tipos de campañas
    Route::resource('Tipocampaña', TipoCampañaController::class);
    Route::post('tipos/{campaña}/dropzone', [TipoCampañaController::class, 'dropzone'])->name('campaña.dropzone');


    Route::resource('Charlas', CharlasController::class);
    Route::get('Charlas/{charla}/download', [CharlasController::class, 'downloadOne'])->name('charla.downloadOne');
    Route::get('Charlas/{charla}/documento', [CharlasController::class, 'documento'])->name('charla.documento');
    Route::get('Charlas/{charla}/imagen', [CharlasController::class, 'imagen'])->name('charla.imagen');
    Route::post('Charlas/download', [CharlasController::class, 'downloadFound'])->name('charla.downloadFound');
    Route::get('Charlas/encontrado/excel',[CharlasController::class,'dowloadExport'])->name('export.excell');
    Route::get('Charlas/{charla}/eleminar/documentos', [CharlasController::class, 'documentosDelete'])->name('charla.documentos.delete');
    Route::post('Charlas/{charla}/dropzone/documento', [CharlasController::class, 'dropzone'])->name('charla.documento.dropzone');
    Route::post('Charlas/{charla}/dropzone', [CharlasController::class, 'dropzoneImagen'])->name('charla.imagen.dropzone');
    Route::get('Charlas/{charla}/eleminar/imagen', [CharlasController::class, 'imagenDelete'])->name('charla.imagen.delete');


    // ruta de generar link (solo admin)
    Route::get('/generar-link', [FormularioController::class, 'generarLink'])->name('formulario.generar');

    //pruebas
    Route::get('pruebas/nada',[ConfiguaracionController::class,'nada'])->name('prueba.nada');
    
    //Mascotas
    Route::resource('Mascotas', MascotasController::class);
    Route::post('Mascotas/Found', [MascotasController::class, 'Found'])->name('Mascotas.found');
    Route::get('Mascotas/encontrado/excel',[MascotasController::class,'dowloadExport'])->name('Mascotas.excell');


});




// rutas públicas (sin auth)
Route::middleware([])->group(function () {
    Route::get('/formulario/{token}', [FormularioController::class, 'mostrar'])->name('formulario.mostrar');
    Route::post('/formulario/guardar', [FormularioController::class, 'guardar'])->name('formulario.guardar');
});