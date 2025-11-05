<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class AsistenteController extends Controller
{
    //
    public function index()
    {
        
        
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
        $Idusuario=Auth::user()->id;
        $resultado=DB::statement('EXEC dbo.InserAsistenteCampaña ?,?,?,?,?,?,?',[
            $request->campañaId,
            $request->especialidad,
            $Idusuario,
            $request->AsistenteName,
            $request->AsistenteApelliP,
            $request->AsistenApellM,
            $request->AsitenteDni,
        ]);
        if ($resultado === true) {
            session()->flash('swal', [
                'icon' => 'success',
                'title' => '¡Buen trabajo!',
                'text' => 'Se registró el usuario correctamente'
            ]);
        } else {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'No se registró el usuario correctamente'
            ]);
        }

        return redirect()->route('admin.Campañas.index');
        
    } 

    public function show($id)
    {
       //descargar los asistentes de la campaña
       $informacion=DB::select('EXEC dbo.ViewsAsistentesCampañas ?',[$id]);
       //$fecha = Carbon::now()->format('dmY');
       
        if (empty($informacion[0])) {
            # ver si esta vacio
             # code...
            session()->flash('swal', [
                    'icon' => 'error',
                    'title' => '¡Ups!',
                    'text' => 'no cuenta con asistentes registrados'
                ]);
            return redirect()->route('admin.Campañas.index');
            
        } else {
            $resultado = collect($informacion);
            $primero = $resultado->first();
            return Excel::download(new \App\Exports\AsistenteExport($resultado),'E-'.$primero->Tnombre_Tipocampaña.'-'.$primero->DfechaIni_campaña.'.xlsx');
        }
        
        
       
    }


    public function edit($id)
    {
        return $id;
    }

    public function update(Request $request, $id)
    {
        $resultado = DB::statement('EXEC dbo.EliminarAsitenteCampaña ?', [$id]);
        if ($resultado === true) {
            session()->flash('swal', [
                'icon' => 'success',
                'title' => '¡El usuario fue eliminado de sla campaña!',
                'text' => 'Se elimino usuario correctamente'
            ]);
        } else {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'No se eliino usuario correctamente'
            ]);
        }

        return redirect()->route('admin.Campañas.index');
    }
    
   

    public function destroy($id)
    {
        
    }
}
