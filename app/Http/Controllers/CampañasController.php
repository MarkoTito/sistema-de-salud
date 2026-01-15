<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class CampañasController extends Controller
{
    //
    public function index()
    {
        // Ejecutas tus procedimientos
        Gate::authorize('view-campañas');
        $results = DB::select('EXEC dbo.viewCampañas');
        $Tiposcampañas = DB::select('EXEC dbo.ViewsTiposCampañas');
        $Colaboradores = DB::select('EXEC dbo.ViewsColaboradores');

        // Convertir a colección
        $collection = collect($results);

        // Parámetros de paginación
        $perPage = 10; 
        $page = request()->get('page', 1); 

        $items = $collection->slice(($page - 1) * $perPage, $perPage)->values();

        $campañas = new LengthAwarePaginator(
            $items,
            $collection->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

       
        return view('admin/campaña/viewCampaña', compact('campañas', 'Tiposcampañas', 'Colaboradores'));
    }

    public function create()
    {
        Gate::authorize('create-campañas');
        $Tiposcampañas=DB::select('EXEC dbo.ViewsTiposCampañas');
        $Tiposcampañas=DB::select('EXEC dbo.ViewsTiposCampañas');
        $Colaboradores=DB::select('EXEC dbo.ViewsColaboradores');
        $especialidadades=DB::select('EXEC dbo.ViewEspecialidades2');
        
        return view('admin/campaña/newCampaña',compact('Tiposcampañas','Colaboradores','especialidadades'));
    }

    public function viewImportar($id)
    {
        
        return view('admin/campaña/viewImportar',compact('id'));
    }

    public function dropzoneImpor(Request $request, $id)
    {
        #paara la importacion de asistentes a cmapañas
        $request->validate([
            'archivo' => 'required|file|mimes:xlsx,xls,pdf'
        ]);

        Excel::import(new \App\Imports\UserImport($id), $request->file('excel'));
    
        session()->flash('swal', [
                'icon' => 'success',
                'title' => '¡Buen trabajo!',
                'text' => 'Se agrego asistentes a la campaña correctamente '
            ]);
        return redirect()->route('admin.Campañas.show',$id);
    }


    public function store(Request $request)
    {
        Gate::authorize('create-campañas');
        
        $request->validate([
                'Campañas' => 'required|integer',
                'colaborador' => 'required',
                'especialidad' => 'required',
                'DfechaIni_campaña' => 'required|date',

                'hora_inicio' => 'required',
                'Tlugar_campaña' => 'required|string|max:150',
            ],
            [],
            [
                'Campañas' => 'Tipo de campaña',
                'colaborador' => 'Colaborador',
                'especialidad' => 'Especialidad',

                'DfechaIni_campaña' => 'Fecha de campaña',
                'hora_inicio' => 'Hora inicio',
                'Tlugar_campaña' => 'Lugar de campaña',
            ]
        );

        // return $request;
       //return $request->opciones[0];
        $Idusuario = Auth::user()->id;
        //fecha de cracion , para luego sacar cuando se cierra la insercion de documentos
        $FechCierre= Carbon::now()->addDays(3);


        
        $resultado = DB::select('EXEC dbo.InserCampaña ?, ?, ?, ?, ?', [
            $request->Campañas,
            $Idusuario,
            $request->DfechaIni_campaña,

            $request->hora_inicio,
            $request->Tlugar_campaña,
            // $FechCierre
        ]);

        $idInsertado = $resultado[0]->id_insertado;

        #insercion en la talba relacion de colaborador y campaña
        $colaborador = explode(',', $request->colaborador);
        $cant= count($colaborador);
        
        for ($i=0; $i <$cant ; $i++) { 
            $idColaborador = intval(trim($colaborador[$i]));
            $colCampa = DB::select('EXEC dbo.InserCampaña_colaborador ?, ?', [
                $idInsertado,
                $idColaborador
            ]);
        }

        #insercion en la talba relacion de especialidad y campaña
        $especialidad = explode(',', $request->especialidad);
        $cant= count($especialidad);
        
        for ($i=0; $i <$cant ; $i++) { 
            $idEspecialidad = intval(trim($especialidad[$i]));
            $colCampa = DB::select('EXEC dbo.InserCampaña_Especie ?, ?', [
                $idInsertado,
                $idEspecialidad
            ]);
        }
        // insersion en la talba de modificacion
        $tipoInser="camp";
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
                'text' => 'No se registro la campaña correctamente'
            ]);
        } else {
            session()->flash('swal', [
                'icon' => 'success',
                'title' => '¡Buen trabajo!',
                'text' => 'Se registro la campaña correctamente'
            ]);
            
        } 
        return redirect()->route('admin.Campañas.index');
        // try {
            

        // } catch (\Throwable $e) {
        //     return response()->json([
        //         'ok' => false,
        //         'msg' => 'Error en el servidor',
        //         'error' => $e->getMessage(),
        //         'trace' => $e->getTraceAsString()
        //     ], 500);
        // }
    }

    public function show($id)
    {
        Gate::authorize('view-campañas');
        $campañaShow = DB::select('EXEC dbo.OneCAMPAÑA ? ',[$id]);

        



        //imagen
        $Tiposcampañas=DB::select('EXEC dbo.ViewsTiposCampañas');
        $resulAsistentes= DB::select('EXEC dbo.ViewsAsistentesCampañas ? ',[$id]);
        $especialidades= DB::select('EXEC dbo.ViewEspecialidades2');
        //te muestre todos los colaboradores de la campaña
        $colaboradores= DB::select('EXEC dbo.ViewColaboradoresCamp ?',[$id]);
        $OnEspecialidadades= DB::select('EXEC dbo.ViewCruseEspecialidades ?',[$id]);
        $cantidad= count($resulAsistentes);

        $documentos = collect(DB::select('EXEC dbo.ViewDocumentCamp ?', [$id]));

        // return $OnEspecialidadades;
        $fechaHora = Carbon::parse($campañaShow[0]->DfechaIni_campaña . ' ' . $campañaShow[0]->ThoraIni_campaña);
        if ($fechaHora->lessThan(Carbon::now())) {
            if ($campañaShow[0]->Nestado_campaña ==3) {
                # significa ya paso su hoora de open (pero ya finalizo)
                $estado = 'reabrir campaña?';
            } else {
                # code...
                // Significa que la fecha/hora ya pasó (y esta abierto)
                $estado = 'Finalizar';
            }
            
        } else {
            // Significa que es en el futuro
            $estado = 'Empesar antes de tiempo';
        }
        if (!empty($campañaShow)) {
            $campaña = $campañaShow[0];

            //mostrar los dias que quedan para q suban sus evidencias
            $hoy = Carbon::now();
            $Inicio = Carbon::parse($campaña->DfechaIni_campaña);

            $dias = $Inicio->diffInDays($hoy);
            // $Cierre = Carbon::parse($campaña->DfechaCierre_campaña);
            // $total = $dias -3;

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
            if ($dias> 3) {
                $Drestantes=-1;
            }
                 
            
            
            // return $Drestantes;



        
            // return $diasRestantes; 
            $imagen = collect(DB::select('EXEC dbo.ViewImagenCampañas ?', [$id]));
            $colaboradores= DB::select('EXEC dbo.ViewColaboradoresCamp ?',[$id]);

            // aca
            $collection = collect($resulAsistentes);

            // Parámetros de paginación
            $perPage = 5; 
            $page = request()->get('page', 1); 

            $items = $collection->slice(($page - 1) * $perPage, $perPage)->values();

            $asistentes = new LengthAwarePaginator(
                $items,
                $collection->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );
            //ACA PROCEDEROMOS HACER EL CONTEO DE LAS MASCOTAS , SI ES QUE FUERA CAMPAÑA MASCOTAS
            //perros
            $cantiPerros =0 ;
            $cantiGatos =0 ;

            foreach ($resulAsistentes as $asisPerro) {
                if ($asisPerro->NTipoMascota_asistente==1) {
                    $cantiPerros = 1+ $cantiPerros;
                }
            }
            foreach ($resulAsistentes as $asisGato) {
                if ($asisGato->NTipoMascota_asistente==2) {
                    $cantiGatos = 1+ $cantiGatos;
                    
                }
            }
            // return $imagen;
            return view('admin.campaña.oneCampaña', compact('documentos','cantiPerros','cantiGatos','campaña','OnEspecialidadades','especialidades','asistentes','cantidad','estado','imagen','colaboradores','Drestantes'));
        } else {
            return redirect()->back()->with('error', 'No se encontró la campaña.');
        }
    }

    public function imagen(string $id)
    {
        return view('admin/campaña/IngreImagenCampaña', compact('id'));
    }

    public function documento(string $id)
    {
        return view('admin/campaña/documentoCampaña', compact('id'));
    }

    public function dropzoneImagen(Request $request, $id)
    {
        $file = $request->file('file');
        $path = Storage::put('imagenes', $file);
        $size = $file->getSize();

        $resultado = DB::statement('EXEC dbo.InsertarImagenCamapañ ?, ?, ?', [
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
    public function dropzoneDocumento(Request $request, $id)
    {
        $file = $request->file('file');
        $path = Storage::put('documentos', $file);
        $size = $file->getSize();

        $resultado = DB::statement('EXEC dbo.InsertarDocumenCamapaña ?, ?, ?', [
               $id,
               $size,
               $path       
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Se subio correctamente los documentos',
            'resultado' => $resultado
        ]);
    }

    public function edit($id)
    {
        Gate::authorize('update-campañas');
        $campañaShow = DB::select('EXEC dbo.OneCAMPAÑA ? ',[$id]);
        $Tiposcampañas=DB::select('EXEC dbo.ViewsTiposCampañas');
        $Colaboradores=DB::select('EXEC dbo.ViewsColaboradores');
        
        if (!empty($campañaShow)) {
            $imagen = collect(DB::select('EXEC dbo.ViewImagenCampanias ?', [$id]))->last();
            $campaña = $campañaShow[0];
            return view('admin/campaña/editCampaña',compact('campaña','Tiposcampañas','Colaboradores','imagen'));
        } else {
            return redirect()->back()->with('error', 'No se encontró la campaña.');
        }
        
    }
    public function destroy($id)
    {
        
        
    }

    public function documentosDelete($id)
    {
        Gate::authorize('view-charlas');  
        $resultado = DB::statement('EXEC dbo.EliminarDocumentoCharla ?', [
               $id        
            ]);

        $busqueda= collect(DB::select('EXEC dbo.ViewDocumento ? ',[$id]))->first();
        $IDCampaña= $busqueda->FK_Documento_campañaId;

        session()->flash('swal', [
                    'icon' => 'success',
                    'title' => '¡Buen trabajo!',
                    'text' => 'Se elemino el documento correctamente'
                ]);
        return redirect()->route('admin.Campañas.show',$IDCampaña);


    }

    public function update(Request $request, $id)
    {        
        Gate::authorize('update-campañas');
        $Idusuario = Auth::user()->id;
            $tipoInser="camp";
            $tipoModi=3;

        if ($request->situacion ==1 ) {
            # para finalizarlo
            $resultado=DB::statement('EXEC dbo.FinalizarCampaña ? ',[$id]);
            // insersion en la talba de modificacion
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
                    'text' => 'Se finalizo la campaña correctamente'
                ]);
            } else {
                session()->flash('swal', [
                    'icon' => 'error',
                    'title' => '¡Ups!',
                    'text' => 'No se finalizo la campaña correctamente'
                ]);
            }   
        } 
        if ($request->situacion ==2 ) {
            #para adelnatarlo
            
            $resultado=DB::statement('EXEC dbo.AdelantarCampaña ? ',[$id]);
            // insersion en la talba de modificacion
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
                    'text' => 'Se adelanto la campaña correctamente'
                ]);
            } else {
                session()->flash('swal', [
                    'icon' => 'error',
                    'title' => '¡Ups!',
                    'text' => 'No se adelanto la campaña correctamente'
                ]);
            }   
        }
        if ($request->situacion ==3 ) {
            #para adelnatarlo
            $resultado=DB::statement('EXEC dbo.ReabirCampaña ? ',[$id]);
            // insersion en la talba de modificacion
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
                    'text' => 'Se reabrió  la campaña correctamente'
                ]);
            } else {
                session()->flash('swal', [
                    'icon' => 'error',
                    'title' => '¡Ups!',
                    'text' => 'No se reabrió  la campaña correctamente'
                ]);
            }   
        } 
        if ($request->situacion ==4 ) {
            $resultado=DB::statement('EXEC dbo.EditarCampaña ?,?,?,?,?',
            [
                $id,
                $request->newCampaña,
                $request->newFecha ,
                $request->newHora ,
                $request->newLugar
            ]);
            // insersion en la talba de modificacion
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
        }
        return redirect()->route('admin.Campañas.show',$id);
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
        return redirect()->route('admin.Campañas.show',$imagen->FK_Imagen_CamapañaId);
    }

    public function AsistentesCampaPdfs($id){
        $fecha = Carbon::now()->format('dmY');
        
        $informacion=DB::select('EXEC dbo.ViewsAsistentesCampañas ?',[$id]);
        
        if (empty($informacion[0])) {    
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'no existe asistentes registrados'
            ]);
            return redirect()->route('admin.Campañas.index');                
        }
        $campaña= $informacion[0];
        
        // $resultado = collect($informacion);
        $pdf =Pdf::loadView('admin.PDF.AsistentesCamapañaPdf',[
            'asistente' =>$informacion,
            'campaña'=>$campaña,
            'fecha' => $fecha
        ])->setPaper('a4', 'landscape');
        return $pdf->download("PDF-$campaña->Tnombre_Tipocampaña-$fecha.pdf");

    }
    
}
