<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use Illuminate\Support\Facades\Crypt; //seguridad osea cifrado
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class MascotasController extends Controller
{
    //
    public function index()
    {
        Gate::authorize('view-mascotas');  
        $results=DB::select('EXEC dbo.viewMascotas');

        // Convertir a colección
        $collection = collect($results);

        // Parámetros de paginación
        $perPage = 20; 
        $page = request()->get('page', 1); 

        $items = $collection->slice(($page - 1) * $perPage, $perPage)->values();

        $mascotas = new LengthAwarePaginator(
            $items,
            $collection->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );


        return view('admin/Veterinaria/Mascotas',compact('mascotas'));
    }

    public function create()
    {
        #para el veterninario
        Gate::authorize('create-mascotas');  
        $razas = DB::select('EXEC dbo.viewRazas');
        $identificadores = DB::select('EXEC dbo.viewIdentificaciones');
        return view('admin/Veterinaria/newMascota',compact('razas','identificadores'));
    }

    public function registro()
    {
        #para el ciudadano
        
        $razas = DB::select('EXEC dbo.viewRazas');
        $identificadores = DB::select('EXEC dbo.viewIdentificaciones');
        return view('admin/Veterinaria/RegistroMascotaPublico',compact('razas','identificadores'));
    }

    public function store(Request $request)
    {
        Gate::authorize('create-mascotas');  
        // $Idusuario = Auth::user()->id;
        $viewDueño=DB::select('EXEC dbo.FoundResponsable ?',[$request->dniRes]);

        if (!empty($viewDueño)) {
            // aca el dueño ya fue registrado
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
                    // insersion en la talba de modificacion
                    // $tipoInser="masco";
                    // $tipoModi=1;
                    // DB::statement('EXEC dbo.InsertarModificacion ?,?,?,?', [
                    //         $idMascota,
                    //         $tipoInser,
                    //         $tipoModi,
                    //         $Idusuario
                    // ]);

                    if ($mascota && $mascota[0]->estado === 'OK') {
                        return response()->json([
                            'success' => true,
                            ]);
                    } else {
                        return response()->json(['success' => false]);
                    }


        } 
        else {
            $responsable=DB::select('EXEC dbo.InserResponsable  ?,? ,?,?,?, ?,?,?',
            [
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
                            // insersion en la talba de modificacion
                            // $tipoInser="masco";
                            // $tipoModi=1;
                            // DB::statement('EXEC dbo.InsertarModificacion ?,?,?,?', [
                            //         $idMascota,
                            //         $tipoInser,
                            //         $tipoModi,
                            //         $Idusuario
                            // ]);
                            //envio al correo
                            // if ($request->correo) {
                            //     $url = route('perro.carnet', $idMascota);
                            //     $options = new QROptions([
                            //         'outputType' => QRCode::OUTPUT_IMAGE_PNG,
                            //         'scale' => 5,
                            //     ]);
                                
                            //     $qr = (new QRCode($options))->render($url);


                            //     Mail::to($request->correo)->send(new \App\Mail\ConfimacionMascota($qr));
                            // }

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

    public function LibreStore(Request $request)
    {

        try {
            // $Idusuario = Auth::user()->id;
            $viewDueño=DB::select('EXEC dbo.FoundResponsable ?',[$request->dniRes]);
    
            if (!empty($viewDueño)) {
                // aca el dueño ya fue registrado
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
                        // insersion en la talba de modificacion
                        // $tipoInser="masco";
                        // $tipoModi=1;
                        // DB::statement('EXEC dbo.InsertarModificacion ?,?,?,?', [
                        //         $idMascota,
                        //         $tipoInser,
                        //         $tipoModi,
                        //         $Idusuario
                        // ]);
    
                        if ($mascota && $mascota[0]->estado === 'OK') {
                            return response()->json([
                                'success' => true,
                                ]);
                        } else {
                            return response()->json(['success' => false]);
                        }
    
    
            } 
            else {
                $responsable=DB::select('EXEC dbo.InserResponsable  ?,? ,?,?,?, ?,?,?',
                [
                    $request->nombreRes,
                    $request->apePaRes,
                    $request->apeMaRes,
    
                    $request->dniRes,
                    $request->numCelRes,
                    $request->direRes,
    
                    $request->telFijo,
                    $request->correo            
                ]);
    
                if (!$responsable || $responsable[0]->estado !== 'OK') {
                    return response()->json([
                        'success' => false,
                        'message' => 'Error al registrar responsable'
                    ], 400);
                }
        
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
                                // insersion en la talba de modificacion
                                // $tipoInser="masco";
                                // $tipoModi=1;
                                // DB::statement('EXEC dbo.InsertarModificacion ?,?,?,?', [
                                //         $idMascota,
                                //         $tipoInser,
                                //         $tipoModi,
                                //         $Idusuario
                                // ]);
    
    
                                //envio al correo
                                // if ($request->correo) {
                                //     $url = route('perro.carnet', $idMascota);
                                //     $options = new QROptions([
                                //         'outputType' => QRCode::OUTPUT_IMAGE_PNG,
                                //         'scale' => 5,
                                //     ]);
                                    
                                //     $qr = (new QRCode($options))->render($url);
    
    
                                //     Mail::to($request->correo)->send(new \App\Mail\ConfimacionMascota($qr));
                                // }
    
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
        } catch (\Throwable $e) {

            Log::error('Mascota LibreStore', [
                'error' => $e->getMessage()
            ]);
    
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() // 👈 ESTE es el error real
            ], 500);
        }

        return response()->json(['success' => false]);
    } 

    public function show ($idCifrado)
    {
        Gate::authorize('read-mascotas');  
        $id = Crypt::decryptString($idCifrado);
        $resultado=DB::select('EXEC dbo.OneMascota ? ',[$id]);
        $mascota= $resultado[0];
        $idresponsable= $mascota->PK_Responsable;
        $documentos = collect(DB::select('EXEC dbo.ViewDocumentResponsable ?', [$idresponsable]));
        //$resulIma = collect(DB::select('EXEC dbo.ViewImagenMascota ?', [$id]));
        $imagen = collect(DB::select('EXEC dbo.ViewImagenMascota ?', [$id]));
        $razas = DB::select('EXEC dbo.viewRazas');
        $identificadores = DB::select('EXEC dbo.viewIdentificaciones');


        $url = route('perro.carnet', $idCifrado);

        $options = new QROptions([
            'outputType' => QRCode::OUTPUT_MARKUP_SVG,
            'scale'      => 5,
        ]);

        // La librería devuelve directamente un Data URI
        $qr = (new QRCode($options))->render($url);



        // return $imagen;
        return view('admin/Veterinaria/oneMascota',compact('qr','mascota','documentos','imagen','razas','identificadores'));
        
    }
    public function carnet($idCifrado)
    {
        $id = Crypt::decryptString($idCifrado);
        $resultado=DB::select('EXEC dbo.OneMascota ? ',[$id]);
        $mascota= $resultado[0];
        $idresponsable= $mascota->PK_Responsable;
        $documentos = collect(DB::select('EXEC dbo.ViewDocumentResponsable ?', [$idresponsable]));
        //$resulIma = collect(DB::select('EXEC dbo.ViewImagenMascota ?', [$id]));
        $imagen = collect(DB::select('EXEC dbo.ViewImagenMascota ?', [$id]));
        $razas = DB::select('EXEC dbo.viewRazas');
        $identificadores = DB::select('EXEC dbo.viewIdentificaciones');
        // return $mascota;
        return view('admin/Veterinaria/carnetMascota',compact('mascota','documentos','imagen','razas','identificadores'));
        
    }


    public function edit($id)
    {
        Gate::authorize('update-mascotas');  
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
        Gate::authorize('update-mascotas');  
        //return $request;
        $resultado=DB::select('EXEC dbo.OneMascota ? ',[$id]);
        $mascota= $resultado[0];
        $idResponsable = $mascota->PK_Responsable;
        

        $correo="";
        $telefono="";
        if (!$request->resEmail) {
            $correo="";
        }else {
            $correo=$request->resEmail;
        }
        if (!$request->resTel) {
            $telefono="";
        }else {
            $telefono=$request->resTel;
        }

        $resultado=DB::statement('EXEC dbo.EditarResponsable ?,?,?,?,?,?,?,?,?',
            [
                $idResponsable,
                $request->resName,
                $request->resApeP,
                $request->resApeM,
                $request->resDNI,
                $request->resCel,
                $request->resDire,
                $telefono,
                $correo

            ]);

        if ($resultado === true) {
            $seña="";
            $fechaNacimiento=null;
            


            if (!$request->masSeñas) {
                $seña="";
            }else {
                $seña=$request->masSeñas;
            }
            if (!$request->fecha) {
                $fechaNacimiento=null;
            }else {
                $fechaNacimiento=$request->fecha;
            }
            
            
            $Mascota=DB::statement('EXEC dbo.EditarMascota ?,?,?,?,?,?,?,?,?,?,?',
            [
                $id,
                $request->raza,
                $request->identificacion,

                $request->masName,
                $request->tipo,
                $request->masColor,

                $request->peligrosidad,
                $seña,
                $fechaNacimiento,

                $request->sexo,
                $request->antecedentes

            ]);
            if ($Mascota === true) {
                // insersion en la talba de modificacion
                $tipoInser="masco";
                $tipoModi=3;
                $Idusuario = Auth::user()->id;
                DB::statement('EXEC dbo.InsertarModificacion ?,?,?,?', [
                        $id,
                        $tipoInser,
                        $tipoModi,
                        $Idusuario
                ]);


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
    
    public function QR($idCifrado)
    {
        //$id = Crypt::decryptString($idCifrado);
        $url = route('perro.carnet', $idCifrado);

        $options = new QROptions([
            'outputType' => QRCode::OUTPUT_MARKUP_SVG,
            'scale'      => 5,
        ]);

        // La librería devuelve directamente un Data URI
        $qr = (new QRCode($options))->render($url);

        return view('admin/Veterinaria/MascotaQR', compact('qr'));
    }

    public function destroy($id)
    {
        Gate::authorize('delete-mascotas');  
        $resultado=DB::statement('EXEC dbo.EliminarMascota ? ',[$id]);
        if ($resultado === true) {
            
            $tipoInser="masco";
            $tipoModi=2;
            $Idusuario = Auth::user()->id;
            DB::statement('EXEC dbo.InsertarModificacion ?,?,?,?', [
                $id,
                $tipoInser,
                $tipoModi,
                $Idusuario
            ]);

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

    public function Found(Request $request)
    {
        Gate::authorize('view-mascotas');  
        $results=DB::select('EXEC dbo.MascotaFound ?,?,?',[
            $request->founTipo,
            $request->fehcIni,
            $request->fehFin,
        ]);
        if (empty($results[0])) {

            session()->flash('swal', [
                    'icon' => 'error',
                    'title' => '¡Ups!',
                    'text' => 'no existe la relacion'
                ]);
            return redirect()->route('admin.Mascotas.index');                
        } else {
            $collection = collect($results);

            $perPage = 5;   
            $page = request()->get('page', 1); 

            $items = $collection->slice(($page - 1) * $perPage, $perPage)->values();

            $mascotas = new LengthAwarePaginator(
                $items,
                $collection->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
            session()->flash('swal', [
                'icon' => 'success',
                'text' => 'Se encontraron relación'
            ]);
            return view('admin/Veterinaria/MascotaFound', compact('mascotas','request'));
        }
    }


    public function dowloadExport(Request $request){
        Gate::authorize('view-mascotas');  
        $informacion=DB::select('EXEC dbo.MascotaFound ?,?,?',[
            $request->founTipo,
            $request->fehcIni,
            $request->fehFin,
        ]);
        if (empty($informacion[0])) {    
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'no existe las charlas'
            ]);
            return redirect()->route('admin.Charlas.index');                
        }
        $resultado = collect($informacion);
        return Excel::download(new \App\Exports\MascotaExport($resultado),'E-Mascota.xlsx');
    }


}
