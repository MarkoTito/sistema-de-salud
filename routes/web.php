<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/','/admin');
use App\Http\Controllers\MascotasController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/perro/carnet/{id}', [MascotasController::class, 'carnet'])->name('perro.carnet');
Route::get('/mascota/publico', [MascotasController::class, 'registro'])->name('perro.publico');



Route::post('Mascotas/regsitro/libre',[MascotasController::class,'LibreStore'])->name('Mascotas.libre');
