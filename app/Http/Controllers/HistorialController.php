<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
class HistorialController extends Controller
{
    //
    public function index()
    {
        //
        $results = DB::select('EXEC dbo.ViewModificaciones');
        $collection = collect($results)->sortByDesc('created_at');
        
        // Parámetros de paginación
        $perPage = 50; 
        $page = request()->get('page', 1); 

        $items = $collection->slice(($page - 1) * $perPage, $perPage)->values();

        $modificaciones = new LengthAwarePaginator(
            $items,
            $collection->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

       
        return view('admin/Historial/historial',compact('modificaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        
        


    }
    public function show($id)
    {
        //usaremos el show para habiliar usuarios
        
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
       
    }
}
