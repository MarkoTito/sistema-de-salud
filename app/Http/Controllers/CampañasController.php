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
        
        return view('admin/campaña/viewCampaña', compact('campañas'));
        
    }

    public function create()
    {
        $Tiposcampañas=DB::select('EXEC dbo.ViewsTiposCampañas');
        $Colaboradores=DB::select('EXEC dbo.ViewsColaboradores');
        
        return view('admin/campaña/newCampaña',compact('Tiposcampañas','Colaboradores'));
    }

    public function store(Request $request)
    {
        //funcion para ingresar a la tabla campañas
        $Idusuario=Auth::user()->id;
        $resultado=DB::statement('EXEC dbo.InserCampaña ?,?,?,?,?,?',[
            $request->Campañas,
            $request->colaborador,
            $Idusuario,
            $request->DfechaIni_campaña,
            $request->hora_inicio,
            $request->Tlugar_campaña,
        ]);
        if ($resultado === true) {
            session()->flash('swal', [
                'icon' => 'success',
                'title' => '¡Buen trabajo!',
                'text' => 'Se registró la campaña correctamente'
            ]);
        } else {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'No se registró la campaña correctamente'
            ]);
        }

        return redirect()->route('admin.Campañas.index');
    } 

    public function show($id)
    {
        $campañaShow = DB::select('EXEC dbo.OneCAMPAÑA ? ',[$id]);
        $especialidades = DB::select('EXEC dbo.ViewsEspecialidad');
        $asistentes= DB::select('EXEC dbo.ViewsAsistentesCampañas ? ',[$id]);
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
            return view('admin.campaña.oneCampaña', compact('campaña','especialidades','asistentes','cantidad','estado'));
        } else {
            return redirect()->back()->with('error', 'No se encontró la campaña.');
        }
    }


    public function edit($id)
    {
        return $id;
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
        return redirect()->route('admin.Campañas.index');
    }
     public function adelantar(Request $request, $id)
    {
        //funcion para adelantar la campañas
        //$Idusuario=Auth::user()->id;
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

        return redirect()->route('admin.Campañas.index');
    } 

    public function destroy($id)
    {
        
    }
}
