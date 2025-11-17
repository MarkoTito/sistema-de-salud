<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
         return view('admin/nada');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'mensaje' => 'required|string|max:250',
                'tipo' => 'required|integer|in:1,2,3'
            ]);

        if ($validated['tipo']==1) {
            $creacionCampaña = DB::select('EXEC dbo.InsertarTiposCampañas ?, ?', [
                $validated['nombre'],   
                $validated['mensaje'],  
            ]);
    
            if (!empty($creacion)) {
                return response()->json(['ok' => true, 'data' => $creacionCampaña[0]]);
            }

            return response()->json(['ok' => false, 'msg' => 'No se registró la campaña']);
        }
        if ($validated['tipo']==2) {
            $creacionCharla = DB::select('EXEC dbo.InsertarTiposCharla ?, ?', [
                $validated['nombre'],   
                $validated['mensaje'],  
            ]);
    
            if (!empty($creacionCharla)) {
                return response()->json([
                    'ok' => true,
                    'data' => $creacionCharla[0]   
                ]);
            }
            return response()->json([
                'ok' => false,
                'msg' => 'No se registró el tipo de charla'
            ]);
        }
        if ($validated['tipo']==3) {
            $validated = $request->validate([
                    'nombre' => 'required|string|max:255',
                    'mensaje' => 'required|string|max:250',
                    'tipo' => 'required|integer|in:1,2'
                ]);
            $creacionCharla = DB::select('EXEC dbo.InsertarTiposExpo ?, ?', [
                $request->nombre,  
                $request->apeP ,
                $request->apeM,
                $request->Numero,  
            ]);
    
            if (!empty($creacionCharla)) {
                return response()->json([
                    'ok' => true,
                    'data' => $creacionCharla[0]   
                ]);
            }
            return response()->json([
                'ok' => false,
                'msg' => 'No se registró el el expositor'
            ]);
        }

        
    } 

    public function show($id)
    {
       
    }


    public function edit($id)
    {
        #se elimino la campaña , nose  xq aca si funciona?
        $campañaShow = DB::select('EXEC dbo.EliminarCampaña ? ',[$id]);
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
       
    }
    
   

    public function destroy($id)
    {
        
        return "hola";
        
    }
}
