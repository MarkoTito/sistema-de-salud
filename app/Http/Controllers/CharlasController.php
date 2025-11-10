<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;


class CharlasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $results = DB::select('EXEC dbo.viewCharlas');

        // Convertir a colección
        $collection = collect($results);

        // Parámetros de paginación
        $perPage = 10; 
        $page = request()->get('page', 1); 

        $items = $collection->slice(($page - 1) * $perPage, $perPage)->values();

        $charlas = new LengthAwarePaginator(
            $items,
            $collection->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

       
        return view('admin/charla/viewCharla', compact('charlas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Tiposcharlas=DB::select('EXEC dbo.ViewsTiposCharlas');
        $Colaboradores=DB::select('EXEC dbo.ViewsColaboradores');
        return view('admin/charla/newCharla', compact('Tiposcharlas','Colaboradores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'charlas' => 'required|exists:tiposcharla,PK_TiposCharla',
            'DfechaIni_charla' => 'required|date|after_or_equal:today',
            'Tlugar_charla' => 'required|string|max:300',
            'TdescripcionLugar_charla' => 'required|string|max:300',
            'hora' => 'required|date_format:H:i',
            
        ], [
            'charlas.required' => 'Debe seleccionar una charla.',
            'DfechaIni_charla.required' => 'Debe ingresar la fecha de inicio.',
            'Tlugar_charla.max' => 'El lugar no debe superar los 300 caracteres.',
            'TdescripcionLugar_charla.max' => 'La descripción no debe superar los 300 caracteres.',
            'hora.required' => 'Debe indicar la hora.',
        ]);

        $Idusuario = Auth::user()->id;

        $resultado = DB::select('EXEC dbo.InserCharla ?, ?, ?, ?, ? , ?', [
                $validated['charlas'],
                $Idusuario,
                $validated['DfechaIni_charla'],
                $validated['hora'],
                $validated['Tlugar_charla'],
                $validated['TdescripcionLugar_charla'],
            ]);

            $idInsertado = $resultado[0]->id_insertado;

            $cant= count($request->opciones);
            
            
            for ($i=0; $i <$cant ; $i++) { 
                $colCampa = DB::select('EXEC dbo.InserCharla_colaborador ?, ?', [
                    $idInsertado,
                    $request->opciones[$i]
                ]);
            }

            if ($colCampa === true) {
                session()->flash('swal', [
                    'icon' => 'error',
                    'title' => '¡Ups!',
                    'text' => 'No se registro la charla correctamente'
                ]);
            } else {
                session()->flash('swal', [
                    'icon' => 'success',
                    'title' => '¡Buen trabajo!',
                    'text' => 'Se registro la charla correctamente'
                ]);
                
            } 
            return redirect()->route('admin.Charlas.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $charlaShow = DB::select('EXEC dbo.OneCHARLA ? ',[$id]);
        $charla = $charlaShow[0];
        return view('admin/charla/oneCharla', compact('charla'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $charlaShow = DB::select('EXEC dbo.OneCHARLA ? ',[$id]);
        $Tiposcharlas=DB::select('EXEC dbo.ViewsTiposCharlas');
        $charla = $charlaShow[0];
        return view('admin/charla/editCharla', compact('charla','Tiposcharlas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $resultado=DB::statement('EXEC dbo.EditarCharla ?,?,?,?,?,?',
            [
                $id,
                $request->newtipo,
                $request->fecha ,
                $request->hora ,
                $request->lugar,
                $request->lugarEspe

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
        return redirect()->route('admin.Charlas.show',$id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resultado=DB::statement('EXEC dbo.EliminarCharla ? ',[$id]);
            if ($resultado === true) {
                session()->flash('swal', [
                    'icon' => 'success',
                    'title' => '¡Buen trabajo!',
                    'text' => 'Se elimino la charla correctamente'
                ]);
            } else {
                session()->flash('swal', [
                    'icon' => 'error',
                    'title' => '¡Ups!',
                    'text' => 'No se elimino la charla correctamente'
                ]);
            }   
        return redirect()->route('admin.Charlas.index');
    }
}
