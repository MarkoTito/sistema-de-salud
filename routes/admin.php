<?php

use App\Http\Controllers\AsistenteController;
use App\Http\Controllers\CampañasController;
use App\Http\Controllers\CharlasController;
use App\Http\Controllers\ConfiguaracionController;
use App\Http\Controllers\FormularioController;
use App\Http\Controllers\HistorialController;
use App\Http\Controllers\MascotasController;
use App\Http\Controllers\TipoCampañaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// rutas protegidas (con auth) 
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('Campañas', CampañasController::class);
    Route::get('Campañas/{campaña}/imagen', [CampañasController::class, 'imagen'])->name('campañas.imagen');
    Route::post('Campañas/{campaña}/dropzone', [CampañasController::class, 'dropzoneImagen'])->name('campañas.imagen.dropzone');
    Route::get('Campañas/{campaña}/eleminar/imagen', [CampañasController::class, 'imagenDelete'])->name('campaña.imagen.delete');

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
    //para exportacion de datos unitarios en excel a la BD
    Route::get('Campañas/{charla}/impotar', [CampañasController::class, 'viewImportar'])->name('Campañas.excell.import');
    Route::post('Campañas/{campaña}/dropzone/importacion', [CampañasController::class, 'dropzoneImpor'])->name('campañas.excell.import.dropzone');


    // ruta de generar link (solo admin)
    

    //Configuracion - pruebas
    Route::get('pruebas/nada',[ConfiguaracionController::class,'nada'])->name('prueba.nada');
    Route::resource('usuarios', UserController::class);


    //Mascotas
    Route::resource('Mascotas', MascotasController::class);
    Route::post('Mascotas/Found', [MascotasController::class, 'Found'])->name('Mascotas.found');
    Route::get('Mascotas/encontrado/excel',[MascotasController::class,'dowloadExport'])->name('Mascotas.excell');
    Route::get('Mascotas/certificado/{mascota}',[MascotasController::class,'generarCertificado'])->name('Mascotas.certificado'); //THIS
    Route::get('Mascotas/{mascota}/eleminar/imagen', [MascotasController::class, 'imagenDelete'])->name('Mascotas.imagen.delete');
    Route::get('Mascotas/{mascota}/eleminar/documentos', [MascotasController::class, 'documentosDelete'])->name('mascota.documentos.delete');
    

    //Historial
    Route::resource('Historial', HistorialController::class);
    //qr de mascotas
    Route::get('/perro/{id}/qr', [MascotasController::class, 'QR'])->name('perro.qr');

});




// rutas públicas (sin auth)
Route::middleware([])->group(function () {
    


    Route::get('/formulario/{token}', [FormularioController::class, 'mostrar'])->name('formulario.mostrar');
    Route::post('/formulario/guardar', [FormularioController::class, 'guardar'])->name('formulario.guardar');
});