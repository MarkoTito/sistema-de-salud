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
        $Colaboradores=DB::select('EXEC dbo.ViewsColaboradores');
        
        return view('admin/campaña/newCampaña',compact('Tiposcampañas','Colaboradores'));
    }

    public function viewImportar($id)
    {
        
        return view('admin/campaña/viewImportar',compact('id'));
    }

    public function dropzoneImpor(Request $request, $id)
    {
        #paara la importacion de asistentes a cmapañas
        $request->validate([
            'excel' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        Excel::import(new \App\Imports\UserImport($id), $request->file('excel'));
        // if ($resultado === true) {
        //     session()->flash('swal', [
        //         'icon' => 'success',
        //         'title' => '¡Buen trabajo!',
        //         'text' => 'Se actualizo la campaña correctamente '
        //     ]);
        // } else {
        //     session()->flash('swal', [
        //         'icon' => 'error',
        //         'title' => '¡Ups!',
        //         'text' => 'No se actualizo la campaña correctamente'
        //     ]);
        // } 
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
        // $colaborador = explode(',', $request->colaborador);
        // $cant= count($colaborador);
        // $idColaborador = intval(trim($colaborador[2]));

        try {
            
            $validated = $request->validate([
                'Campañas' => 'required|integer',
                'colaborador' => 'required',
                'DfechaIni_campaña' => 'required|date',
                'hora_inicio' => 'required',
                'Tlugar_campaña' => 'required|string|max:30',
            ]);

        
           //return $request->opciones[0];
            $Idusuario = Auth::user()->id;

            $resultado = DB::select('EXEC dbo.InserCampaña ?, ?, ?, ?, ?', [
                $validated['Campañas'],
                $Idusuario,
                $validated['DfechaIni_campaña'],
                $validated['hora_inicio'],
                $validated['Tlugar_campaña'],
            ]);

            $idInsertado = $resultado[0]->id_insertado;
            $colaborador = explode(',', $request->colaborador);
            $cant= count($colaborador);
            
            
            for ($i=0; $i <$cant ; $i++) { 
                $idColaborador = intval(trim($colaborador[$i]));
                $colCampa = DB::select('EXEC dbo.InserCampaña_colaborador ?, ?', [
                    $idInsertado,
                    $idColaborador
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

        } catch (\Throwable $e) {
            return response()->json([
                'ok' => false,
                'msg' => 'Error en el servidor',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
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
        $cantidad= count($resulAsistentes);




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
            $imagen = collect(DB::select('EXEC dbo.ViewImagenCampanias ?', [$campaña->PK_TiposCampañas]))->last();
            $colaboradores= DB::select('EXEC dbo.ViewColaboradoresCamp ?',[$id]);

            // aca
            $collection = collect($resulAsistentes);

            // Parámetros de paginación
            $perPage = 2; 
            $page = request()->get('page', 1); 

            $items = $collection->slice(($page - 1) * $perPage, $perPage)->values();

            $asistentes = new LengthAwarePaginator(
                $items,
                $collection->count(),
                $perPage,
                $page,
                ['path' => request()->url(), 'query' => request()->query()]
            );

           
            return view('admin.campaña.oneCampaña', compact('campaña','especialidades','asistentes','cantidad','estado','imagen','colaboradores'));
        } else {
            return redirect()->back()->with('error', 'No se encontró la campaña.');
        }
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
    

    
}
