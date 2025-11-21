<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MascotasController extends Controller
{
    //
    public function index()
    {
        $mascotas=DB::select('EXEC dbo.viewMascotas');
        return view('admin/Veterinaria/Mascotas',compact('mascotas'));
    }

    public function create()
    {
        $razas = DB::select('EXEC dbo.viewRazas');
        $identificadores = DB::select('EXEC dbo.viewIdentificaciones');
        return view('admin/Veterinaria/newMascota',compact('razas','identificadores'));
    }

    public function store(Request $request)
    {
        
        $Idusuario = Auth::user()->id;
        $viewDueño=DB::select('EXEC dbo.FoundResponsable ?',[$request->dniRes]);

        if (!empty($viewDueño)) {
            $idResponsable= $viewDueño[0]->PK_Responsable;
            
            $mascota=DB::select('EXEC dbo.InserMascota  ?,?,?,?,?,?,?,?,?,?,?',
                    [
                        $idResponsable,
                        $request->raza,
                        $request->identificacion,
                        $request->nombreMas,
                        $request->tipo,
                        $request->color,
                        $request->peligrocidad,
                        $request->señales,
                        $request->fechaNaci,
                        $request->sexo,
                        $request->antecedentes,
            
                    ]);
            $idMascota = $mascota[0]->id_insertado;

                    if ($request->hasFile('docuImagen')) {
                            $file = $request->file('docuImagen');
                            $path = Storage::put('documentos', $file);
                            $size = $file->getSize();
                            $nombre = $file->getClientOriginalName();

                            DB::statement('EXEC dbo.InsertarDocumentoRespon ?, ?, ?,?', [
                                $idResponsable,
                                $size,
                                $path,
                                $nombre
                            ]);
                    }
                    if ($request->hasFile('residenciaDoc')) {
                            $file = $request->file('residenciaDoc');
                            $path = Storage::put('documentos', $file);
                            $size = $file->getSize();
                            $nombre = $file->getClientOriginalName();

                            DB::statement('EXEC dbo.InsertarDocumentoRespon ?, ?, ?,?', [
                                $idResponsable,
                                $size,
                                $path,
                                $nombre
                                
                            ]);
                    }

                    
                    if ($request->hasFile('certiMascota')) {
                            $file = $request->file('certiMascota');
                            $path = Storage::put('documentos', $file);
                            $size = $file->getSize();
                            $nombre = $file->getClientOriginalName();

                            DB::statement('EXEC dbo.InsertarDocumentoRespon ?, ?, ?,?', [
                                $idResponsable,
                                $size,
                                $path,
                                $nombre
                                
                            ]);
                    }
                    if ($request->hasFile('fotoMascota')) {
                        foreach ($request->file('fotoMascota') as $file) {

                            if ($file->isValid()) {

                                $path = $file->store('imagenes');
                                $size = $file->getSize();

                                DB::statement('EXEC dbo.InsertarImagenMascota ?, ?, ?', [
                                    $idMascota,
                                    $size,
                                    $path,
                                ]);
                            }
                        }
                    }




                    if ($mascota && $mascota[0]->estado === 'OK') {
                        return response()->json([
                            'success' => true,
                            ]);
                    } else {
                        return response()->json(['success' => false]);
                    }


        } 
        else {
            $responsable=DB::select('EXEC dbo.InserResponsable  ?,?,?,?,?,?,?,?,?',
            [
                $Idusuario,
                $request->nombreRes,
                $request->apePaRes,
                $request->apeMaRes,
                $request->dniRes,
                $request->numCelRes,
                $request->direRes,
                $request->telFijo,
                $request->correo            
            ]);
    
            if ($responsable && $responsable[0]->estado === 'OK') {
    
                $idResponsable = $responsable[0]->id_insertado;
    
                $mascota=DB::select('EXEC dbo.InserMascota  ?,?,?,?,?,?,?,?,?,?,?',
                    [
                        $idResponsable,
                        $request->raza,
                        $request->identificacion,
                        $request->nombreMas,
                        $request->tipo,
                        $request->color,
                        $request->peligrocidad,
                        $request->señales,
                        $request->fechaNaci,
                        $request->sexo,
                        $request->antecedentes,
                    
                    ]);

                    
                if ($mascota && $mascota[0]->estado === 'OK') {
                    $idMascota = $mascota[0]->id_insertado;
                        
                    if ($mascota && $mascota[0]->estado === 'OK') {

                        if ($request->hasFile('docuImagen')) {
                                $file = $request->file('docuImagen');
                                $path = Storage::put('documentos', $file);
                                $size = $file->getSize();
                                $nombre = $file->getClientOriginalName();

                                DB::statement('EXEC dbo.InsertarDocumentoRespon ?, ?, ?,?', [
                                    $idResponsable,
                                    $size,
                                    $path,
                                    $nombre
                                ]);
                        }
                        if ($request->hasFile('residenciaDoc')) {
                                $file = $request->file('residenciaDoc');
                                $path = Storage::put('documentos', $file);
                                $size = $file->getSize();
                                $nombre = $file->getClientOriginalName();

                                DB::statement('EXEC dbo.InsertarDocumentoRespon ?, ?, ?,?', [
                                    $idResponsable,
                                    $size,
                                    $path,
                                    $nombre
                                    
                                ]);
                        }

                        
                        if ($request->hasFile('certiMascota')) {
                                $file = $request->file('certiMascota');
                                $path = Storage::put('documentos', $file);
                                $size = $file->getSize();
                                $nombre = $file->getClientOriginalName();

                                DB::statement('EXEC dbo.InsertarDocumentoRespon ?, ?, ?,?', [
                                    $idResponsable,
                                    $size,
                                    $path,
                                    $nombre
                                    
                                ]);
                        }
                        if ($request->hasFile('fotoMascota')) {
                            foreach ($request->file('fotoMascota') as $file) {

                                if ($file->isValid()) {

                                    $path = $file->store('imagenes');
                                    $size = $file->getSize();

                                    DB::statement('EXEC dbo.InsertarImagenMascota ?, ?, ?', [
                                        $idMascota,
                                        $size,
                                        $path,
                                    ]);
                                }
                            }
                        }




                        if ($mascota && $mascota[0]->estado === 'OK') {
                            return response()->json([
                                'success' => true,
                                ]);
                        } else {
                            return response()->json(['success' => false]);
                        }


                    } else {
                        return response()->json(['success' => false]);
                    }
                }
            }


        }
        return response()->json(['success' => false]);
    } 

    public function show($id)
    {
        $resultado=DB::select('EXEC dbo.OneMascota ? ',[$id]);
        $mascota= $resultado[0];
        $idresponsable= $mascota->PK_Responsable;
        $documentos = collect(DB::select('EXEC dbo.ViewDocumentResponsable ?', [$idresponsable]));
        //$resulIma = collect(DB::select('EXEC dbo.ViewImagenMascota ?', [$id]));
        $imagen = collect(DB::select('EXEC dbo.ViewImagenMascota ?', [$id]));
        $razas = DB::select('EXEC dbo.viewRazas');
        $identificadores = DB::select('EXEC dbo.viewIdentificaciones');
        // return $mascota;
        return view('admin/Veterinaria/oneMascota',compact('mascota','documentos','imagen','razas','identificadores'));
        
    }


    public function edit($id)
    {
        $resultado=DB::select('EXEC dbo.OneMascota ? ',[$id]);
        $mascota= $resultado[0];
        $documentos = collect(DB::select('EXEC dbo.ViewDocumentResponsable ?', [$id]));
        
        $imagen = collect(DB::select('EXEC dbo.ViewImagenMascota ?', [$id]))->last();

        $razas = DB::select('EXEC dbo.viewRazas');
        $identificadores = DB::select('EXEC dbo.viewIdentificaciones');
        
        return view('admin/Veterinaria/editMascota',compact('mascota','documentos','imagen','razas','identificadores'));
    }

    public function update(Request $request, $id)
    {
        //return $request;
        $resultado=DB::select('EXEC dbo.OneMascota ? ',[$id]);
        $mascota= $resultado[0];
        $idResponsable = $mascota->PK_Responsable;
        
        $resultado=DB::statement('EXEC dbo.EditarResponsable ?,?,?,?,?,?,?,?,?',
            [
                $idResponsable,
                $request->resName,
                $request->resApeP,
                $request->resApeM,
                $request->resDNI,
                $request->resCel,
                $request->resDire,
                $request->resTel,
                $request->resEmail

            ]);

        if ($resultado === true) {

            
            $Mascota=DB::statement('EXEC dbo.EditarMascota ?,?,?,?,?,?,?,?,?,?,?',
            [
                $id,
                $request->raza,
                $request->identificacion,

                $request->masName,
                $request->tipo,
                $request->masColor,

                $request->peligrosidad,
                $request->masSeñas,
                $request->fecha,

                $request->sexo,
                $request->antecedentes

            ]);
            if ($Mascota === true) {
                session()->flash('swal', [
                    'icon' => 'success',
                    'title' => '¡Buen trabajo!',
                    'text' => 'Se edito la informacion correctamente'
                ]);
                return redirect()->route('admin.Mascotas.show', [$id]);
            }
            else {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'No edito la informacion correctamente'
            ]);
            return redirect()->route('admin.Mascotas.edit', [$id]);
        }   
        } else {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'No edito la informacion correctamente'
            ]);
            return redirect()->route('admin.Mascotas.edit', [$id]);
        }   
        return redirect()->route('admin.Mascotas.edit', [$id]);
    }
    
   

    public function destroy($id)
    {
        $resultado=DB::statement('EXEC dbo.EliminarMascota ? ',[$id]);
        if ($resultado === true) {
            session()->flash('swal', [
                'icon' => 'success',
                'title' => '¡Buen trabajo!',
                'text' => 'Se elimino la mascota correctamente'
            ]);
        } else {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'No se mascota la charla correctamente'
            ]);
        }   
        return redirect()->route('admin.Mascotas.index');
          
    }
}
