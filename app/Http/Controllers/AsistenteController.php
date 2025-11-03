<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
