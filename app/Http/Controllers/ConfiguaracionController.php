<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ConfiguaracionController extends Controller
{
    //
    public function index()
    {
        $Tiposcampañas=DB::select('EXEC dbo.ViewsTiposCampañas');
        $TiposCharlas=DB::select('EXEC dbo.ViewsTiposCharlas');
        $expositores=DB::select('EXEC dbo.ViewsExpositores');
        return view('admin/configuracion/configuracion',compact('Tiposcampañas','TiposCharlas','expositores'));
        
    }

    public function create()
    {
        
    }
    public function nada()
    {
        $Tiposcampañas=DB::select('EXEC dbo.ViewsTiposCampañas');
        $TiposCharlas=DB::select('EXEC dbo.ViewsTiposCharlas');
        $expositores=DB::select('EXEC dbo.ViewExpositores2');
        $users=DB::select('EXEC dbo.ViewUser');
        $especialidadades=DB::select('EXEC dbo.ViewEspecialidades2');
        // return $especialidadades;
        return view('admin/nada',compact('Tiposcampañas','TiposCharlas','expositores','users','especialidadades'));
    }

    public function store(Request $request)
    {
        if ($request->tipo == 1) {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'mensaje' => 'required|string|max:250',
                'tipo' => 'required|integer|in:1,2,3'
            ]);

            $creacionCampaña = DB::select('EXEC dbo.InsertarTiposCampañas ?, ?', [
                $validated['nombre'],
                $validated['mensaje'],
            ]);

            return response()->json([
                'ok' => !empty($creacionCampaña),
                'data' => $creacionCampaña[0] ?? null,
                'msg' => empty($creacionCampaña) ? 'No se registró la campaña' : null
            ]);
        }

        if ($request->tipo == 2) {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'mensaje' => 'required|string|max:250',
                'tipo' => 'required|integer|in:1,2,3'
            ]);

            $creacionCharla = DB::select('EXEC dbo.InsertarTiposCharla ?, ?', [
                $validated['nombre'],
                $validated['mensaje'],
            ]);

            return response()->json([
                'ok' => !empty($creacionCharla),
                'data' => $creacionCharla[0] ?? null,
                'msg' => empty($creacionCharla) ? 'No se registró el tipo de charla' : null
            ]);
        }

        if ($request->tipo == 3) {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'apeP' => 'required|string|max:255',
                'apeM' => 'required|string|max:255',
                'Numero' => 'required',
            ]);

            $creacionExpo = DB::select('EXEC dbo.InsertarTiposExpo ?,?,?,?', [
                $validated['nombre'],
                $validated['apeP'],
                $validated['apeM'],
                $validated['Numero'],
            ]);

            return response()->json([
                'ok' => true,
                'msg' => 'Registrado correctamente'
            ]);
        }
        if ($request->tipo == 4) {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'tipo' => 'required|integer|in:1,2,3,4'
            ]);

            $creacionEspecialidad = DB::select('EXEC dbo.InsertarEspecialidad ?', [
                $validated['nombre'],
            ]);

            return response()->json([
                'ok' => !empty($creacionEspecialidad),
                'data' => $creacionEspecialidad[0] ?? null,
                'msg' => empty($creacionEspecialidad) ? 'No se registró la especialidad' : null
            ]);
        }
        
    }

    public function show($id)
    {
       return $id;
    }


    public function edit($id)
    {
        #se elimino la campaña , nose  xq aca si funciona?
        $campañaShow = DB::select('EXEC dbo.EliminarCampaña ? ',[$id]);
        $Idusuario = Auth::user()->id;
        $tipoInser="camp";
            $tipoModi=2;
            DB::statement('EXEC dbo.InsertarModificacion ?,?,?,?', [
                    $id,
                    $tipoInser,
                    $tipoModi,
                    $Idusuario
                ]);

        if ($campañaShow === true) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'No se elimino la campaña correctamente'
            ]);
        } else {
            session()->flash('swal', [
                'icon' => 'success',
                'title' => '¡Buen trabajo!',
                'text' => 'Se elimino la campaña correctamente'
            ]);
            
        }

        return redirect()->route('admin.Campañas.index');
    }

    public function update(Request $request, $id)
    {
       if ($request->tipo == 'down') {
            if ($request->confi == 'espe') {
                DB::select(' EXEC dbo.EliminarEspeci ? ',[$id]);
                    session()->flash('swal', [
                    'icon' => 'success',
                    'title' => '¡Buen trabajo!',
                    'text' => 'Se elimino la especialidad correctamente'
                ]);
            }
            if ($request->confi == 'expo') {
                DB::select(' EXEC dbo.EliminarExpo ? ',[$id]);
                    session()->flash('swal', [
                    'icon' => 'success',
                    'title' => '¡Buen trabajo!',
                    'text' => 'Se elimino la especialidad correctamente'
                ]);
            }
            if ($request->confi == 'charla') {
                DB::select(' EXEC dbo.EliminarTipocharla ? ',[$id]);
                    session()->flash('swal', [
                    'icon' => 'success',
                    'title' => '¡Buen trabajo!',
                    'text' => 'Se elimino el tipo de charla correctamente'
                ]);
            }
            if ($request->confi == 'campa') {
                DB::select(' EXEC dbo.EliminarTipoCampaña ? ',[$id]);
                    session()->flash('swal', [
                    'icon' => 'success',
                    'title' => '¡Buen trabajo!',
                    'text' => 'Se elimino el tipo de campaña correctamente'
                ]);
            }
       }
       if ($request->tipo == 'up') {
            if ($request->confi == 'espe') { 
                DB::select(' EXEC dbo.habilitarEspeci ? ',[$id]);
                    session()->flash('swal', [
                    'icon' => 'success',
                    'title' => '¡Buen trabajo!',
                    'text' => 'Se habilito la especialidad correctamente'
                ]);
            }
            if ($request->confi == 'expo') {
                DB::select(' EXEC dbo.habilitarExpo ? ',[$id]);
                    session()->flash('swal', [
                    'icon' => 'success',
                    'title' => '¡Buen trabajo!',
                    'text' => 'Se habilito el expositor correctamente'
                ]);
            }
            if ($request->confi == 'charla') {
                DB::select(' EXEC dbo.habilitarTipocharla ? ',[$id]);
                    session()->flash('swal', [
                    'icon' => 'success',
                    'title' => '¡Buen trabajo!',
                    'text' => 'Se habilito el tipo de charla correctamente'
                ]);
            }
            if ($request->confi == 'campa') {
                DB::select(' EXEC dbo.habilitarTipoCampaña ? ',[$id]);
                    session()->flash('swal', [
                    'icon' => 'success',
                    'title' => '¡Buen trabajo!',
                    'text' => 'Se habilito el tipo de campaña correctamente'
                ]);
            }
       }
       return redirect()->route('admin.prueba.nada');
    }
    
   

    public function destroy($id)
    {
        
        return "hola";
        
    }
}
