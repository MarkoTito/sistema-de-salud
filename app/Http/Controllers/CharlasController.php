<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Barryvdh\DomPDF\Facade\Pdf;

class CharlasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        Gate::authorize('view-charlas');  
        $results = DB::select('EXEC dbo.viewCharlas');
        $Tiposcharlas=DB::select('EXEC dbo.ViewsTiposCharlas');
        // Convertir a colección
        $collection = collect($results);
        
        // Parámetros de paginación
        $perPage = 5; 
        $page = request()->get('page', 1); 

        $items = $collection->slice(($page - 1) * $perPage, $perPage)->values();

        $charlas = new LengthAwarePaginator(
            $items,
            $collection->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

       
        return view('admin/charla/viewCharla', compact('charlas','Tiposcharlas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create-charlas');  
        $Tiposcharlas=DB::select('EXEC dbo.ViewsTiposCharlas');
        $expositores=DB::select('EXEC dbo.ViewExpositores');
        return view('admin/charla/newCharla', compact('Tiposcharlas','expositores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $expositores1 = explode(',', $request->expositores);
        // $cant= count($expositores1);
        // $idColaborador = intval(trim($expositores1[2]));
        // return $idColaborador;

        Gate::authorize('create-charlas');  
        $validated=$request->validate([
            'charlas' => 'required',
            'DfechaIni_charla' => 'required|date|after_or_equal:today',
            'horaIni' => 'required|date_format:H:i',
            'horaFin' => 'required|date_format:H:i|after:horaIni',
            'Tlugar_charla' => 'required|string|max:150',
            'TdescripcionLugar_charla' => 'required|string|max:50',
            'expositores' => 'required'
        ], [
            'charlas.required' => 'Debe seleccionar un tipo de charla.',
            'charlas.exists' => 'El tipo de charla seleccionado no es válido.',
            'DfechaIni_charla.required' => 'Debe seleccionar una fecha.',
            'DfechaIni_charla.after_or_equal' => 'La fecha debe ser hoy o una fecha futura.',
            'horaIni.required' => 'Debe ingresar la hora de inicio.',
            'horaFin.required' => 'Debe ingresar la hora de fin.',
            'horaFin.after' => 'La hora de fin debe ser mayor que la hora de inicio.',
            'Tlugar_charla.required' => 'Debe ingresar el lugar.',
            'Tlugar_charla.max' => 'El lugar no debe tener más de 150 caracteres.',
            'TdescripcionLugar_charla.required' => 'Debe ingresar la descripción del lugar.',
            'TdescripcionLugar_charla.max' => 'La descripción no debe tener más de 50 caracteres.',
            'expositores.required' => 'Debe seleccionar un expositor.',

        ]);

        $Idusuario = Auth::user()->id;
        //fecha de cracion , para luego sacar cuando se cierra la insercion de documentos
        $FechCierre= Carbon::now()->addDays(3);
    
        $resultado = DB::select('EXEC dbo.InserCharla ?,?,?, ?,?,?, ?,?', [
                $validated['charlas'],
                $Idusuario,
                $validated['DfechaIni_charla'],

                $validated['horaIni'],
                $validated['horaFin'],
                $validated['Tlugar_charla'],

                $validated['TdescripcionLugar_charla'],
                $FechCierre
            ]);

            #insercion a la talba realcion
            $idInsertado = $resultado[0]->id_insertado;


            $expositores1 = explode(',', $request->expositores);
            $cant= count($expositores1);
            
            
            for ($i=0; $i <$cant ; $i++) { 
                $expositor = intval(trim($expositores1[$i]));
                $colCampa = DB::select('EXEC dbo.InserCharla_expositor ?, ?', [
                    $idInsertado,
                    $expositor
                ]);
            }
            
            // insersion en la talba de modificacion
            $tipoInser="charl";
            $tipoModi=1;
            DB::statement('EXEC dbo.InsertarModificacion ?,?,?,?', [
                    $idInsertado,
                    $tipoInser,
                    $tipoModi,
                    $Idusuario
                ]);


            if ($colCampa === true) {
                session()->flash('swal', [
                    'icon' => 'error',
                    'title' => '¡Ups!',
                    'text' => 'No se registro la charla correctamente'
                ]);
            } else {
                session()->flash('swal', [
                    'icon' => 'success',
                    'title' => '¡Buen trabajo!',
                    'text' => 'Se registro la charla correctamente'
                ]);
                
            } 
            return redirect()->route('admin.Charlas.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        Gate::authorize('read-charlas');  
        $charlaShow = DB::select('EXEC dbo.OneCHARLA ? ',[$id]);
        $expositores = DB::select('EXEC dbo.ViewsColaboradoresCharlas ? ',[$id]);
        $documentos = collect(DB::select('EXEC dbo.ViewDocumentCharla ?', [$id]));
        $imagenes = collect(DB::select('EXEC dbo.ViewImagenCharla ?', [$id]));
        $charla = $charlaShow[0];

        
        //mostrar los dias que quedan para q suban sus evidencias
        $hoy = Carbon::now();
        $Inicio = Carbon::parse($charla->DfechaIni_charla);

        $dias = $Inicio->diffInDays($hoy);
        // $Cierre = Carbon::parse($campaña->DfechaCierre_campaña);
        $total = $dias -3;

        $Drestantes = 0;
        if ($dias> 0) {
            $Drestantes=3;
        }
        if ($dias > 1) {
            $Drestantes=2;
        }
        if ($dias> 2) {
            $Drestantes=1;
        }


        //asitentes de charla
        $asitentes1 = DB::select('EXEC dbo.ViewsAsistentescharlas ?', [$id]);

        $cantidad= count($asitentes1);
        $collection = collect($asitentes1);
        
        // return $cantidad;
        // Parámetros de paginación
        $perPage = 8; 
        $page = request()->get('page', 1); 

        $items = $collection->slice(($page - 1) * $perPage, $perPage)->values();

        $asitentes = new LengthAwarePaginator(
            $items,
            $collection->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        // return $asitentes;
        return view('admin/charla/oneCharla', compact('cantidad','asitentes','charla','expositores','documentos','imagenes','Drestantes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        Gate::authorize('update-charlas');  
        $charlaShow = DB::select('EXEC dbo.OneCHARLA ? ',[$id]);
        $Tiposcharlas=DB::select('EXEC dbo.ViewsTiposCharlas');
        $charla = $charlaShow[0];
        return view('admin/charla/editCharla', compact('charla','Tiposcharlas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('update-charlas');  

        //return  $request;
        
        if ($request->newtipo ==1) {
            $resultado=DB::statement('EXEC dbo.EditarCharlaCam ?,?,?, ?,?,?, ?,?,?',
            [
                    $id,
                    $request->newtipo,
                    $request->fecha ,
    
                    $request->hora ,
                    $request->horafIN ,
                    $request->lugar,
                    
                    $request->lugarEspe,
                    $request->canti_perro,
                    $request->canti_gato,
    
            ]);
        } else {
            # code...
            $resultado=DB::statement('EXEC dbo.EditarCharla ?,?,?,?,?,?,?,?',
            [
                    $id,
                    $request->newtipo,
                    $request->fecha ,
    
                    $request->hora ,
                    $request->horafIN ,
                    $request->lugar,
                    
                    $request->lugarEspe,    
                    $request->canti,
    
            ]);
        }
        

        // insersion en la talba de modificacion
        $Idusuario = Auth::user()->id;
        $tipoInser="charl";
        $tipoModi=3;
        DB::statement('EXEC dbo.InsertarModificacion ?,?,?,?', [
                $id,
                $tipoInser,
                $tipoModi,
                $Idusuario
        ]);
            
            
        if ($resultado === true) {
            session()->flash('swal', [
                'icon' => 'success',
                'title' => '¡Buen trabajo!',
                'text' => 'Se actualizo la campaña correctamente '
            ]);
        } else {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'No se actualizo la campaña correctamente'
            ]);
        } 
        return redirect()->route('admin.Charlas.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('delete-charlas');  
        $resultado=DB::statement('EXEC dbo.EliminarCharla ? ',[$id]);
            if ($resultado === true) {
                // insersion en la talba de modificacion
                $Idusuario = Auth::user()->id;
                $tipoInser="charl";
                $tipoModi=2;
                DB::statement('EXEC dbo.InsertarModificacion ?,?,?,?', [
                        $id,
                        $tipoInser,
                        $tipoModi,
                        $Idusuario
                ]);
                session()->flash('swal', [
                    'icon' => 'success',
                    'title' => '¡Buen trabajo!',
                    'text' => 'Se elimino la charla correctamente'
                ]);
            } else {
                session()->flash('swal', [
                    'icon' => 'error',
                    'title' => '¡Ups!',
                    'text' => 'No se elimino la charla correctamente'
                ]);
            }   
        return redirect()->route('admin.Charlas.index');
    }

    public function downloadOne(string $id)
    {
        Gate::authorize('view-charlas');  
        $informacion=DB::select('EXEC dbo.ViewsAsistentescharlas ?',[$id]);
        

        if (empty($informacion[0])) {

            session()->flash('swal', [
                    'icon' => 'error',
                    'title' => '¡Ups!',
                    'text' => 'no contiene asistentes'
                ]);
            return redirect()->route('admin.Charlas.index');
            
        } else {
            $resultado = collect($informacion);
            $primero = $resultado->first();

            
            return Excel::download(new \App\Exports\CharlaExport($resultado),'E-'.$primero->Tnombre_charla.'-'.$primero->DfechaIni_charla.'.xlsx');
        }
    }

    public function downloadFound(Request $request)
    {
        Gate::authorize('view-charlas');  
        if (!$request->founCharla & !$request->fehcIni ) {
            session()->flash('swal', [
                    'icon' => 'error',
                    'title' => '¡Ups!',
                    'text' => 'Debe de rellenar un campo mínimo'
                ]);
            return redirect()->route('admin.Charlas.index');
        } else {
            $results=DB::select('EXEC dbo.CharLAFound ?, ?',[
                $request->founCharla,
                $request->fehcIni,
                $request->fehFin
            ]);
            if (empty($results[0])) {
    
                session()->flash('swal', [
                        'icon' => 'error',
                        'title' => '¡Ups!',
                        'text' => 'no existe las charlas'
                    ]);
                return redirect()->route('admin.Charlas.index');                
            } else {
                $Tiposcharlas=DB::select('EXEC dbo.ViewsTiposCharlas');
                $collection = collect($results);

                $perPage = 5; 
                $page = request()->get('page', 1); 

                $items = $collection->slice(($page - 1) * $perPage, $perPage)->values();

                $charlas = new LengthAwarePaginator(
                    $items,
                    $collection->count(),
                    $perPage,
                    $page,
                    ['path' => request()->url(), 'query' => request()->query()]
                );
                session()->flash('swal', [
                    'icon' => 'success',
                    'text' => 'Se encontraron las charlas'
                ]);


                return view('admin/charla/foundCharla', compact('charlas','Tiposcharlas','request'));
                
            }
        }
    }

    public function documento(string $id)
    {
        Gate::authorize('view-charlas');  
        return view('admin/charla/documenCharla', compact('id'));
    }

    public function imagen(string $id)
    {
        Gate::authorize('view-charlas');  
        return view('admin/charla/imagenCharla', compact('id'));
    }

    public function dowloadExport(Request $request){
        #este descarga la busuqeda de charlas
        Gate::authorize('view-charlas');  
        $informacion=DB::select('EXEC dbo.CharlaFoundExport ?, ?',[
                $request->founCharla,
                $request->fehcIni
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
        return Excel::download(new \App\Exports\CharlaExport($resultado),'Descarga.xlsx');
    }

    public function dropzone(Request $request, $id)
    {
        Gate::authorize('view-charlas');  
        #para agregar documentos
        $file = $request->file('file');
        $path = Storage::put('documentos', $file);
        $size = $file->getSize();
        $nombre = $file->getClientOriginalName();

        // Usamos DB::select en lugar de DB::statement
        $resultado = DB::statement('EXEC dbo.DocumentoCharla ?, ?, ?,?', [
               $id,
               $size,
               $path,
               $nombre
               
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Se subio correctamente el archivo',
            'resultado' => $resultado
        ]);
    }

    public function documentosDelete($id)
    {
        Gate::authorize('view-charlas');  
        $resultado = DB::statement('EXEC dbo.EliminarDocumentoCharla ?', [
               $id        
            ]);

        session()->flash('swal', [
                    'icon' => 'success',
                    'title' => '¡Buen trabajo!',
                    'text' => 'Se elemino el documento correctamente'
                ]);
        return redirect()->route('admin.Charlas.show',$id);
    }

    public function dropzoneImagen(Request $request, $id)
    {
        Gate::authorize('view-charlas');  
        $file = $request->file('file');
        $path = Storage::put('imagenes', $file);
        $size = $file->getSize();

        $resultado = DB::statement('EXEC dbo.InsertarImagenCharla ?, ?, ?', [
               $id,
               $size,
               $path       
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Se subio correctamente las imagenes',
            'resultado' => $resultado
        ]);
    }


    
    public function imagenDelete($id)
    {
        Gate::authorize('view-charlas');  
        $resultado = DB::statement('EXEC dbo.EliminarImagenCharla ?', [
               $id        
            ]);

        session()->flash('swal', [
                    'icon' => 'success',
                    'title' => '¡Buen trabajo!',
                    'text' => 'Se elemino la imagen correctamente'
                ]);
        return redirect()->route('admin.Charlas.index');
    }


    public function AsistentesCharlaPdfs($id){
        $fecha = Carbon::now()->format('dmY');
        
        $informacion=DB::select('EXEC dbo.ViewsAsistentescharlas ?',[$id]);
        $charla= $informacion[0];
        
        // return $informacion;
        if (empty($informacion[0])) {    
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'no existe las charlas'
            ]);
            return redirect()->route('admin.Charlas.index');                
        }

        
        $pdf =Pdf::loadView('admin.PDF.AsistentesCharlaPdf',[
            'asistente' =>$informacion,
            'charla'=>$charla,
            'fecha' => $fecha
        ])->setPaper('a4', 'landscape');
        return $pdf->download("PDF-$charla->Tnombre_charla-$fecha.pdf");

    }


}
