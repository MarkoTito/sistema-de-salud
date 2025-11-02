<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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
