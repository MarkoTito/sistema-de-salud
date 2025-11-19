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

        // $viewDueño=DB::select('EXEC dbo.FoundResponsable ?',['72921093']);
        // return $viewDueño[0]->PK_Responsable;
        
    }

    public function create()
    {
        $razas = DB::select('EXEC dbo.viewRazas');
        $identificadores = DB::select('EXEC dbo.viewIdentificaciones');
        return view('admin/Veterinaria/newMascota',compact('razas','identificadores'));
    }

    public function store(Request $request)
    {
        // $idMascota = $mascota[0]->id_insertado;
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
            
                    if ($request->hasFile('docuImagen') && $request->file('docuImagen')->isValid()) {
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
                    if ($request->hasFile('residenciaDoc') && $request->file('residenciaDoc')->isValid()) {
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

                    if ($request->hasFile('certiMascota') && $request->file('certiMascota')->isValid()) {
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

                    if ($request->hasFile('fotoMascota') && $request->file('fotoMascota')->isValid()) {
                            $file = $request->file('fotoMascota');
                            $path = Storage::put('imagenes', $file);
                            $size = $file->getSize();

                            DB::statement('EXEC dbo.InsertarImagenMascota   ?, ?,?', [
                                $idMascota,
                                $size,
                                $path,
                            ]);
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

                $idMascota = $mascota[0]->id_insertado;

                if ($mascota && $mascota[0]->estado === 'OK') {
        
                    if ($mascota && $mascota[0]->estado === 'OK') {

                        if ($request->hasFile('docuImagen') && $request->file('docuImagen')->isValid()) {
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
                        if ($request->hasFile('residenciaDoc') && $request->file('residenciaDoc')->isValid()) {
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
                        if ($request->hasFile('certiMascota') && $request->file('certiMascota')->isValid()) {
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

                        if ($request->hasFile('fotoMascota') && $request->file('fotoMascota')->isValid()) {
                            $file = $request->file('fotoMascota');
                            $path = Storage::put('imagenes', $file);
                            $size = $file->getSize();
                            $nombre = $file->getClientOriginalName();

                            DB::statement('EXEC dbo.InsertarImagenMascota  ?, ?,?', [
                                $idMascota,
                                $size,
                                $path,
                                
                            ]);
                        }

                        return response()->json([
                            'success' => true,
                        ]);


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
       
    }


    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
    {
       
    }
    
   

    public function destroy($id)
    {
        
          
    }
}
