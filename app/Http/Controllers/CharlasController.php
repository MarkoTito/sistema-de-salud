<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
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
        $Tiposcharlas=DB::select('EXEC dbo.ViewsTiposCharlas');
        // Convertir a colección
        $collection = collect($results);

        // Parámetros de paginación
        $perPage = 5; 
        $page = request()->get('page', 1); 

        $items = $collection->slice(($page - 1) * $perPage, $perPage)->values();

        $charlas = new LengthAwarePaginator(
            $items,
            $collection->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

       
        return view('admin/charla/viewCharla', compact('charlas','Tiposcharlas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Tiposcharlas=DB::select('EXEC dbo.ViewsTiposCharlas');
        $expositores=DB::select('EXEC dbo.ViewExpositores');
        return view('admin/charla/newCharla', compact('Tiposcharlas','expositores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated=$request->validate([
            'charlas' => 'required',
            'DfechaIni_charla' => 'required|date|after_or_equal:today',
            'horaIni' => 'required|date_format:H:i',
            'horaFin' => 'required|date_format:H:i|after:horaIni',
            'Tlugar_charla' => 'required|string|max:30',
            'TdescripcionLugar_charla' => 'required|string|max:50',
        ], [
            'charlas.required' => 'Debe seleccionar un tipo de charla.',
            'charlas.exists' => 'El tipo de charla seleccionado no es válido.',
            'DfechaIni_charla.required' => 'Debe seleccionar una fecha.',
            'DfechaIni_charla.after_or_equal' => 'La fecha debe ser hoy o una fecha futura.',
            'horaIni.required' => 'Debe ingresar la hora de inicio.',
            'horaFin.required' => 'Debe ingresar la hora de fin.',
            'horaFin.after' => 'La hora de fin debe ser mayor que la hora de inicio.',
            'Tlugar_charla.required' => 'Debe ingresar el lugar.',
            'Tlugar_charla.max' => 'El lugar no debe tener más de 30 caracteres.',
            'TdescripcionLugar_charla.required' => 'Debe ingresar la descripción del lugar.',
            'TdescripcionLugar_charla.max' => 'La descripción no debe tener más de 50 caracteres.',
        ]);

        $Idusuario = Auth::user()->id;

        $resultado = DB::select('EXEC dbo.InserCharla ?, ?, ?, ?, ? , ?,?', [
                $validated['charlas'],
                $Idusuario,
                $validated['DfechaIni_charla'],
                $validated['horaIni'],
                $validated['horaFin'],
                $validated['Tlugar_charla'],
                $validated['TdescripcionLugar_charla'],
            ]);

            $idInsertado = $resultado[0]->id_insertado;

            $cant= count($request->opciones);
            
            
            for ($i=0; $i <$cant ; $i++) { 
                $colCampa = DB::select('EXEC dbo.InserCharla_expositor ?, ?', [
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
        $expositores = DB::select('EXEC dbo.ViewsColaboradoresCharlas ? ',[$id]);
        $documentos = collect(DB::select('EXEC dbo.ViewDocumentCharla ?', [$id]));
        $imagenes = collect(DB::select('EXEC dbo.ViewImagenCharla ?', [$id]));
        $charla = $charlaShow[0];
        return view('admin/charla/oneCharla', compact('charla','expositores','documentos','imagenes'));
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
        $resultado=DB::statement('EXEC dbo.EditarCharla ?,?,?,?,?,?,?, ?',
            [
                $id,
                $request->newtipo,
                $request->fecha ,
                $request->hora ,
                $request->horafIN ,
                $request->lugar,
                $request->lugarEspe,
                $request->canti

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
        return redirect()->route('admin.Chamrlas.index');
    }

    public function downloadOne(string $id)
    {
        $informacion=DB::select('EXEC dbo.OneCHARLA ?',[$id]);
        if (empty($informacion[0])) {

            session()->flash('swal', [
                    'icon' => 'error',
                    'title' => '¡Ups!',
                    'text' => 'no existe charla'
                ]);
            return redirect()->route('admin.Charlas.index');
            
        } else {
            $resultado = collect($informacion);
            $primero = $resultado->first();
            return Excel::download(new \App\Exports\CharlaExport($resultado),'E-'.$primero->Tnombre_charla.'-'.$primero->DfechaIni_charla.'.xlsx');
        }
    }
    public function downloadFound(Request $request)
    {
        if (!$request->founCharla & !$request->fehcIni ) {
            session()->flash('swal', [
                    'icon' => 'error',
                    'title' => '¡Ups!',
                    'text' => 'Debe de rellenar un campo mínimo'
                ]);
            return redirect()->route('admin.Charlas.index');
        } else {
            $results=DB::select('EXEC dbo.CharLAFound ?, ?',[
                $request->founCharla,
                $request->fehcIni,
                $request->fehFin
            ]);
            if (empty($results[0])) {
    
                session()->flash('swal', [
                        'icon' => 'error',
                        'title' => '¡Ups!',
                        'text' => 'no existe las charlas'
                    ]);
                return redirect()->route('admin.Charlas.index');                
            } else {
                $Tiposcharlas=DB::select('EXEC dbo.ViewsTiposCharlas');
                $collection = collect($results);

                $perPage = 5; 
                $page = request()->get('page', 1); 

                $items = $collection->slice(($page - 1) * $perPage, $perPage)->values();

                $charlas = new LengthAwarePaginator(
                    $items,
                    $collection->count(),
                    $perPage,
                    $page,
                    ['path' => request()->url(), 'query' => request()->query()]
                );
                session()->flash('swal', [
                    'icon' => 'success',
                    'text' => 'Se encontraron las charlas'
                ]);


                return view('admin/charla/foundCharla', compact('charlas','Tiposcharlas','request'));
                
            }
        }
    }

    public function documento(string $id)
    {
        return view('admin/charla/documenCharla', compact('id'));
    }

    public function imagen(string $id)
    {
        return view('admin/charla/imagenCharla', compact('id'));
    }

    public function     dowloadExport(Request $request){
        #este descarga la busuqeda de charlas
        $informacion=DB::select('EXEC dbo.CharlaFoundExport ?, ?',[
                $request->founCharla,
                $request->fehcIni
        ]);
        if (empty($informacion[0])) {    
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'no existe las charlas'
            ]);
            return redirect()->route('admin.Charlas.index');                
        }
        $resultado = collect($informacion);
        return Excel::download(new \App\Exports\CharlaExport($resultado),'Descarga.xlsx');
    }

    public function dropzone(Request $request, $id)
    {
        #para agregar documentos
        $file = $request->file('file');
        $path = Storage::put('documentos', $file);
        $size = $file->getSize();
        $nombre = $file->getClientOriginalName();

        // Usamos DB::select en lugar de DB::statement
        $resultado = DB::statement('EXEC dbo.DocumentoCharla ?, ?, ?,?', [
               $id,
               $size,
               $path,
               $nombre
               
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Se subio correctamente el archivo',
            'resultado' => $resultado
        ]);
    }

    public function documentosDelete($id)
    {
        $resultado = DB::statement('EXEC dbo.EliminarDocumentoCharla ?', [
               $id        
            ]);

        session()->flash('swal', [
                    'icon' => 'success',
                    'title' => '¡Buen trabajo!',
                    'text' => 'Se elemino el documento correctamente'
                ]);
        return redirect()->route('admin.Charlas.show',$id);
    }

    public function dropzoneImagen(Request $request, $id)
    {
        $file = $request->file('file');
        $path = Storage::put('imagenes', $file);
        $size = $file->getSize();

        $resultado = DB::statement('EXEC dbo.InsertarImagenCharla ?, ?, ?', [
               $id,
               $size,
               $path       
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Se subio correctamente las imagenes',
            'resultado' => $resultado
        ]);
    }
    public function imagenDelete($id)
    {
        $resultado = DB::statement('EXEC dbo.EliminarImagenCharla ?', [
               $id        
            ]);

        session()->flash('swal', [
                    'icon' => 'success',
                    'title' => '¡Buen trabajo!',
                    'text' => 'Se elemino la imagen correctamente'
                ]);
        return redirect()->route('admin.Charlas.index');
    }



}
