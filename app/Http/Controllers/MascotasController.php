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
use Barryvdh\DomPDF\Facade\Pdf;
use chillerlan\QRCode\Output\QRGdImage;

use Carbon\Carbon;

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
        // return $results;

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
        $Idusuario = Auth::user()->id;
        // Log::info($request->all());

        // $request->validate(
        //     [
        //         'nombreRes' => 'required',
        //         'apePaRes' => 'required',
        //         'apeMaRes' => 'required',
        //         'dniRes' => 'required|min:8|max:8',
        //         'numCelRes' => 'required|min:9|max:9',
        //         'direRes' => 'required',
        //         'correo' => 'nullable|email',
        //         'telFijo' => 'nullable',

        //         'nombreMas' => 'required',
        //         'tipo' => 'required',
        //         'raza' => 'required',
        //         'sexo' => 'required',
        //         'fechaNaci' => 'nullable|date',
        //         'color' => 'required',
        //         'antecedentes' => 'required',
        //         'peligrocidad' => 'required',
        //         'señales' => 'nullable',
        //         'identificacion' => 'nullable',
        //     ],
        //     []
        //     ,
        //     [
        //         'nombreRes' => 'Nombre del responsable',
        //         'apePaRes' => 'Ape. Paterno del responsable',
        //         'apeMaRes' => 'Ape. Materno del responsable',
        //         'dniRes' => 'DNI del responsable',
        //         'numCelRes' => 'Celular del responsable',
        //         'direRes' => 'Direccion del responsable',
        //         'correo' => 'Correo del responsable',
        //         'telFijo' => 'Tel. Fijo del responsable',

        //         'nombreMas' => 'Nombre de Mascota',
        //         'tipo' => 'Tipo de Mascota',
        //         'raza' => 'Raza de Mascota',
        //         'sexo' => 'Sexo de Mascota',
        //         'fechaNaci' => 'Fecha de nacimiento de Mascota',
        //         'color' => 'Color de Mascota',
        //         'antecedentes' => 'Antecedentes de agrecividad',
        //         'peligrocidad' => 'Peligrosidad de Mascota',
        //         'señales' => 'Señales particulares',
        //         'identificacion' => 'Tipo de identificacion',
        //     ]


        // );

        
        $viewDueño=DB::select('EXEC dbo.FoundResponsable ?',[$request->dniRes]);

        if (!empty($viewDueño)) {
            
            // aca el dueño ya fue registrado
            $idResponsable= $viewDueño[0]->PK_Responsable;

            //aca se busca la ultima mascota para generar el codigo
            $mascota= DB::select('EXEC dbo.LastMascota');
            $numero="";
            if (!$mascota) {
                $numero="000000001";
            } else {
                $Base=$mascota[0];
                $numero = str_pad($Base->PK_Mascota +1, 9, '0', STR_PAD_LEFT);
            }
            $codigo="C.U-".$numero;


            $mascota=DB::select('EXEC dbo.InserMascota  ?,?,?, ?,?,?, ?,?,? ,?,?,?',
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
                        $codigo
            
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
                    $tipoInser="masco";
                    $tipoModi=1;
                    DB::statement('EXEC dbo.InsertarModificacion ?,?,?,?', [
                            $idMascota,
                            $tipoInser,
                            $tipoModi,
                            $Idusuario
                    ]);

                    if ($mascota && $mascota[0]->estado === 'OK') {
                        return response()->json(['success' => true,]);
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

                //aca se busca la ultima mascota para generar el codigo
                $mascota= DB::select('EXEC dbo.LastMascota');
                $Base=$mascota[0];
                $numero="";
                if (!$Base) {
                    $numero="000000001";
                } else {
                    $numero = str_pad($Base->PK_Mascota +1, 9, '0', STR_PAD_LEFT);
                }
                $codigo="C.U-".$numero;
                

                $mascota=DB::select('EXEC dbo.InserMascota  ?,?,?,?,?,?,?,?,?,?,?,?',
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
                        $codigo
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
                            $tipoInser="masco";
                            $tipoModi=1;
                            DB::statement('EXEC dbo.InsertarModificacion ?,?,?,?', [
                                    $idMascota,
                                    $tipoInser,
                                    $tipoModi,
                                    $Idusuario
                            ]);


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

    public function GenerateCode(){
        //realisaremos la busqueda del codigo de mascota
        $codigos=DB::select('EXEC dbo.viewCode');
        $cant= count($codigos);
        
        $numero = random_int(100000000, 999999999);
        $Newcodigo = 'C.U-'.$numero;
        
        $valor=0;
        for ($i=0; $i <$cant ; $i++) { 
            $Oldcode=$codigos[$i]->Tcodigo_mascota;
            if ($Oldcode) {
                if ($Newcodigo == $Oldcode) {
                    $valor = 1;
                } 
            }
            
        }
        
        $resultado = [
            'valor' => $valor,
            'codigo' => $Newcodigo
        ];
        return $resultado;
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


        // $url = route('perro.carnet', $idCifrado);

        // $options = new QROptions([
        //     'outputType' => QRCode::OUTPUT_MARKUP_SVG,
        //     'scale'      => 5,
        // ]);

        // $qr = 'data:image/png;base64,' . base64_encode(
        //     (new QRCode($options))->render($url)
        // );
        
        // return $documentos;
        return view(
            'admin/Veterinaria/oneMascota',
            compact('mascota','documentos','imagen','razas','identificadores')
        );

        // return view(
        //     'admin/Veterinaria/oneMascota',
        //     compact('qr','mascota','documentos','imagen','razas','identificadores')
        // );
        
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
        
        $imagen = collect(DB::select('EXEC dbo.ViewImagenMascota ?', [$id]));

        $razas = DB::select('EXEC dbo.viewRazas');
        $identificadores = DB::select('EXEC dbo.viewIdentificaciones');
        // return $imagen;
        
        return view('admin/Veterinaria/editMascota',compact('mascota','documentos','imagen','razas','identificadores'));
    }

    public function update(Request $request, $id)
    {
        Gate::authorize('update-mascotas');  
        $idCifrado = Crypt::encryptString($id);
        
        $resultado=DB::select('EXEC dbo.OneMascota ? ',[$id]);
        $mascota= $resultado[0];
        
        $idResponsable = $mascota->PK_Responsable;
        
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
                        $id,
                        $size,
                        $path,
                    ]);
                }
            }
        }
        
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
                return redirect()->route('admin.Mascotas.show', [$idCifrado]);
            }
            else {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'No edito la informacion correctamente'
            ]);
            return redirect()->route('admin.Mascotas.edit', [$idCifrado]);
        }   
        } else {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'No edito la informacion correctamente'
            ]);
            return redirect()->route('admin.Mascotas.edit', [$idCifrado]);
        }   
        return redirect()->route('admin.Mascotas.edit', [$idCifrado]);
    }
    
    public function autentificacion($idCifrado)
    {
        //$id = Crypt::decryptString($idCifrado);
        $url = route('perro.qr', $idCifrado);

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

    public function documentosDelete($id)
    {
        
        $resultado = DB::statement('EXEC dbo.EliminarDocumentoMascota ?', [
               $id        
            ]);

        $busqueda= collect(DB::select('EXEC dbo.ViewDocumento ? ',[$id]))->first();
        $IDresponsable= $busqueda->FK_Documento_ResponsableId;
        
        $encontrada= collect(DB::select('EXEC dbo.MascotaEncontrado ? ',[$IDresponsable]))->first();
        $IdMasctota=$encontrada->PK_Mascota;

        
        session()->flash('swal', [
                    'icon' => 'success',
                    'title' => '¡Buen trabajo!',
                    'text' => 'Se elemino el documento correctamente'
                ]);
        $idCifrado = Crypt::encryptString($IdMasctota);
        return redirect()->route('admin.Mascotas.show', [$idCifrado]);
    }


    public function MascotasPdfs(Request $request){
        $fecha = Carbon::now()->format('dmY');

        $Ini = $request->fehcIni;
        $fin = $request->fehFin;
        $tipo= $request->founTipo;


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

        // $resultado = collect($informacion);
        $pdf =Pdf::loadView('admin.PDF.MascotadPdf',[
            'macotas' =>$informacion,
            'Ini' => $Ini,
            'fin' => $fin,
            'tipo' => $tipo,
            'fecha' => $fecha
        ])->setPaper('a4', 'landscape');
        return $pdf->download("PDF-$fecha.pdf");

    }


    public function generarCertificado($idCifrado)
    {
        $id = Crypt::decryptString($idCifrado);

        $resultado = DB::select('EXEC dbo.OneMascota ?', [$id]);
        $mascota = $resultado[0];

        $imagen = collect(DB::select('EXEC dbo.ViewImagenMascota ?', [$id]))->first();

        /* ========= FONDO ========= */
        $rutaFondo = public_path('certificados/base.jpg');
        $fondoBase64 = 'data:image/jpeg;base64,' . base64_encode(
            file_get_contents($rutaFondo)
        );

        /* ========= FOTO MASCOTA ========= */
        $fotoBase64 = null;

        if ($imagen && $imagen->Tpath_imagenes) {
            $rutaFoto = storage_path('app/public/' . $imagen->Tpath_imagenes);

            if (file_exists($rutaFoto)) {
                $mime = mime_content_type($rutaFoto);
                $fotoBase64 = 'data:' . $mime . ';base64,' . base64_encode(
                    file_get_contents($rutaFoto)
                );
            }
        }

        /* ========= QR ========= */
        $url = route('perro.qr', $idCifrado);

        $options = new QROptions([
            'outputInterface' => QRGdImage::class, // 🔑 GD (PNG)
            'imageBase64' => true,                 // 🔑 Base64
            'scale' => 5,
        ]);

        $qrBase64 = (new QRCode($options))->render($url);

        

        $pdf = Pdf::loadView(
            'admin.Veterinaria.certificado',
            compact('mascota', 'fondoBase64', 'fotoBase64', 'qrBase64')
        )->setPaper('a4', 'landscape');

        return $pdf->download('certificado.pdf');
    }

    public function indexResponsable(Request $request)
    {
        Gate::authorize('create-mascotas');
    
        $viewDueño = DB::select('EXEC dbo.FoundResponsable ?', [$request->dni]);
        
        if (empty($viewDueño)) {

            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'No se encontro responsable registrado'
            ]);

            return response()->json([
                'url' => route('admin.Mascotas.create'),
                'error' => true
            ]);
        }
        $Responsable=$viewDueño[0];
        $id=$Responsable->PK_Responsable;
        session()->flash('swal', [
            'icon' => 'success',
            'text' => 'Se encontro al responsable'
        ]);
        return response()->json([
            'url' => route('admin.Responsable.found',$id),
            'error' => false
        ]);
    }

    public function MascotaCode(Request $request)
    {
        Gate::authorize('create-mascotas');

        $numero= $request->dni;
        $codigo='C.U-'.$numero;
    
        $viewMascota = DB::select('EXEC dbo.BuscarMasCodigo ?', [$codigo]);
        
        if (empty($viewMascota)) {

            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'No se encontro mascota registrado'
            ]);

            return response()->json([
                'url' => route('admin.Mascotas.index'),
                'error' => true
            ]);
        }
        $mascota=$viewMascota[0];
        $id=$mascota->PK_Mascota;


        session()->flash('swal', [
            'icon' => 'success',
            'text' => 'Se encontro mascota'
        ]);

        return response()->json([
            'url' => route('admin.Mascota.code.found',$id),
            'error' => false
        ]);
    }


    public function ResponsableFound($id)
    {
        #para el veterninario
        Gate::authorize('create-mascotas');  
        $razas = DB::select('EXEC dbo.viewRazas');
        $identificadores = DB::select('EXEC dbo.viewIdentificaciones');
        $viewDueño = DB::select('EXEC dbo.FoundResponsableId ?', [$id]);
        $responsable= $viewDueño[0];
        return view('admin/Veterinaria/LookResponsable',compact('razas','identificadores','responsable'));
    }

    public function MacotFoundCodigo($id)
    {
        #para el veterninario
        $mascotas=DB::select('EXEC dbo.OneMascota ? ',[$id]);
        // return $mascotas;
        return view('admin/Veterinaria/Mascotas',compact('mascotas'));
    }


    public function imagenDelete($id)
    {
        Gate::authorize('view-charlas');  
        $imagen = collect(DB::select('EXEC dbo.ViewIdImagen ?', [$id]))->last();
        $resultado = DB::statement('EXEC dbo.EliminarImagenCharla ?', [
               $id        
            ]);

        session()->flash('swal', [
                    'icon' => 'success',
                    'title' => '¡Buen trabajo!',
                    'text' => 'Se elemino la imagen correctamente'
                ]);
        
        $idCifrado = Crypt::encryptString($imagen->FK_Imagen_MascotaId);
        return redirect()->route('admin.Mascotas.show',$idCifrado);
    }


}
