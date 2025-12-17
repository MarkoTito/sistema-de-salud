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
            $Idusuario = Auth::user()->id;

            if ($request->TipoCampa == 1) {
                foreach ($request->mascotas as $m) {
                    $resultado = DB::statement('EXEC dbo.InserAsistenteCampañaMascota ?,?,?,?,? ,?,?,? ,?,?,?', [
                        $request->idCampaña,
                        1,
                        $Idusuario,

                        $request->nombre,
                        $request->apeP,
                        $request->apeM,

                        $request->celular,
                        $request->edad,

                        $request->DNI,
                        $m['especie'],
                        $m['nombre']
                    ]);
                }
            } else {
                $resultado = DB::statement('EXEC dbo.InserAsistenteCampaña2 ?,?,? ,?,?,?, ?,?', [
                    $request->idCampaña,
                    $Idusuario,
                    $request->nombre,

                    $request->apeP,
                    $request->apeM,
                    $request->DNI,

                    $request->celular,
                    $request->edad,
                ]);
            }
            if ($resultado) {
                return response()->json(['ok' => true, 'msg' => 'Asistente registrado correctamente']);
            }

        } catch (\Exception $e) {
            return response()->json([
                'ok' => false,
                'msg' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
            ]);
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
            // return $resultado;
            if ($primero->PK_TiposCampañas ==1) {
                # code...
                return Excel::download(new \App\Exports\AsistenteMascotaExport($resultado),'E-'.$primero->Tnombre_Tipocampaña.'-'.$primero->DfechaIni_campaña.'.xlsx');
            } else {
                # code...
                return Excel::download(new \App\Exports\AsistenteExport($resultado),'E-'.$primero->Tnombre_Tipocampaña.'-'.$primero->DfechaIni_campaña.'.xlsx');
            }
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
                'title' => '¡El usuario fue eliminado de la campaña!',
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
        $resultado = DB::statement('EXEC dbo.EditarAsistenteCampaña ?,?,?,?,?,?,?', [
            $id,
            $request->nombre,
            $request->apellidoP,

            $request->apellidoM,
            $request->dni,
            $request->celular,
            $request->edad,

            
        ]);

        return response()->json(['message' => 'Asistente actualizado correctamente']);



    }
    
   

    public function destroy($id)
    {
        
    }
    public function look(Request $request)
    {
        
        $resultado = DB::select('EXEC dbo.LookAsistentesCampañas ?, ?',[
            $request->dni,
            $request->idcampana
        ]);

        if (count($resultado) > 0) {
            $campañaShow = DB::select('EXEC dbo.OneCAMPAÑA ? ',[$request->idcampana]);
            //imagen
            $Tiposcampañas=DB::select('EXEC dbo.ViewsTiposCampañas');
            //$asistentes= DB::select('EXEC dbo.ViewsAsistentesCampañas ? ',[$id]); == $resultado

            $especialidades= DB::select('EXEC dbo.ViewEspecialidades');

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
                //return $resultado;
                return view('admin.campaña.oneAsitente', compact('campaña','especialidades','resultado','estado','imagen'));
            } else {
                return redirect()->back()->with('error', 'No se encontró la campaña.');
            }
            //return redirect()->route('admin.Asitentes.found')->with(['dni' => $request->dni,'idcampana' => $request->idcampana]);

        } else {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'No se encontro el asistente'
            ]);
            return redirect()->route('admin.Campañas.show',$request->idcampana);
        }
    }

}
