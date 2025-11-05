<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CampañasController extends Controller
{
    //
    public function index()
    {
        $campañas= DB::select('EXEC dbo.viewCampañas');
        $Tiposcampañas=DB::select('EXEC dbo.ViewsTiposCampañas');
        $Colaboradores=DB::select('EXEC dbo.ViewsColaboradores');
        
        return view('admin/campaña/viewCampaña', compact('campañas','Tiposcampañas','Colaboradores'));
        
    }

    public function create()
    {
        $Tiposcampañas=DB::select('EXEC dbo.ViewsTiposCampañas');
        $Colaboradores=DB::select('EXEC dbo.ViewsColaboradores');
        
        return view('admin/campaña/newCampaña',compact('Tiposcampañas','Colaboradores'));
    }

    public function store(Request $request)
    {
        try {
            // 🔹 Validar datos recibidos
            $validated = $request->validate([
                'Campañas' => 'required|integer',
                'colaborador' => 'required|integer',
                'DfechaIni_campaña' => 'required|date',
                'hora_inicio' => 'required',
                'Tlugar_campaña' => 'required|string|max:30',
            ]);

           
            $Idusuario = Auth::user()->id;
            $resultado = DB::statement('EXEC dbo.InserCampaña ?, ?, ?, ?, ?, ?', [
                $validated['Campañas'],
                $validated['colaborador'],
                $Idusuario,
                $validated['DfechaIni_campaña'],
                $validated['hora_inicio'],
                $validated['Tlugar_campaña'],
            ]);

            if ($resultado === true) {
                return response()->json([
                    'ok' => true,
                    'msg' => 'Campaña registrada correctamente'
                ]);
            } else {
                return response()->json([
                    'ok' => false,
                    'msg' => 'No se registró la campaña correctamente'
                ]);
            }

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
        $campañaShow = DB::select('EXEC dbo.OneCAMPAÑA ? ',[$id]);
        //imagen
        $Tiposcampañas=DB::select('EXEC dbo.ViewsTiposCampañas');
        $asistentes= DB::select('EXEC dbo.ViewsAsistentesCampañas ? ',[$id]);
        $especialidades= DB::select('EXEC dbo.ViewsEspecialidad');
        $cantidad= count($asistentes);


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
            $imagen = collect(DB::select('EXEC dbo.ViewImagenCampanias ?', [$campaña->PK_TiposCampañas]))->first();
           
            return view('admin.campaña.oneCampaña', compact('campaña','especialidades','asistentes','cantidad','estado','imagen'));
        } else {
            return redirect()->back()->with('error', 'No se encontró la campaña.');
        }
    }



    public function edit($id)
    {
        $campañaShow = DB::select('EXEC dbo.OneCAMPAÑA ? ',[$id]);
        $Tiposcampañas=DB::select('EXEC dbo.ViewsTiposCampañas');
        $Colaboradores=DB::select('EXEC dbo.ViewsColaboradores');


        if (!empty($campañaShow)) {
            $campaña = $campañaShow[0];
            return view('admin/campaña/editCampaña',compact('campaña','Tiposcampañas','Colaboradores'));
        } else {
            return redirect()->back()->with('error', 'No se encontró la campaña.');
        }
        
    }
    public function destroy($id)
    {
        
        
    }

    public function update(Request $request, $id)
    {        
        if ($request->situacion ==1 ) {
            # para finalizarlo
            $resultado=DB::statement('EXEC dbo.FinalizarCampaña ? ',[$id]);
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
            $resultado=DB::statement('EXEC dbo.EditarCampaña ?,?,?,?,?,?',
            [
                $id,
                $request->newCampaña,
                $request->colaborador,
                $request->newFecha ,
                $request->newHora ,
                $request->newLugar
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
        return redirect()->route('admin.Campañas.index');
    }
    

    
}
