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
        return view('admin/configuracion/configuracion',compact('Tiposcampañas'));
        
    }

    public function create()
    {
        
    }

    public function store(Request $request)
    {
       $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'mensaje' => 'required|string|max:250',
        ]);

        $creacionCampaña = DB::select('EXEC dbo.InsertarTiposCampañas ?, ?', [
            $validated['nombre'],   
            $validated['mensaje'],  
        ]);

        return response()->json(['ok' => true, 'data' => $creacionCampaña]);
        
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
