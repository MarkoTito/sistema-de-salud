<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Log;

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

        try {
            $Idusuario=Auth::user()->id;
            $resultado=DB::statement('EXEC dbo.InserAsistenteCampaña ?,?,?,?,?,?,?',[
                $request->idCampaña,
                $request->especialidad,
                $Idusuario,
                $request->nombre,
                $request->apeP,
                $request->apeM,
                $request->DNI,
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
            return response()->json(['ok' => true, 'msg' => 'Asistente registrado correctamente']);

        } catch (\Exception $e) {
            return response()->json(['ok' => false, 'msg' => 'Error al registrar asitente']);
        }        
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


    public function edit(Request $request, $id)
    {
        
    }

    public function edit2(Request $request, $id)
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
                'text' => 'No se elemino usuario correctamente'
            ]);
        }

        return redirect()->route('admin.Campañas.show',$request->idCampaña);
        
    }

    public function update(Request $request, $id)
    {
        
        Log::info('Llega correctamente', ['id' => $id, 'data' => $request->all()]);
        $resultado = DB::statement('EXEC dbo.EditarAsistenteCampaña ?,?,?,?,?,?', [
            $id,
            $request->nombre,
            $request->apellidoP,
            $request->apellidoM,
            $request->dni,
            $request->especialidad,
        ]);

        return response()->json(['message' => 'Asistente actualizado correctamente']);



    }
    
   

    public function destroy($id)
    {
        
    }
}
