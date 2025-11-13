<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;



class TipoCampañaController extends Controller
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
   
        
    } 

    public function show($id)
    {
       return  view('admin/campaña/imagenCampaña',compact('id'));
    }


    public function edit($id)
    {
   
    }

    public function update(Request $request, $id)
    {
       
    }
    
   

    public function destroy($id)
    {
        
        return "hola";
        
    }
    public function dropzone(Request $request,$id)
    {
        $path= Storage::put('/documentos',$request->file('file'));
        $size = $request->file('file')->getSize();

        $resultado = DB::statement('EXEC dbo.InsertarDocumenteCharla ?, ?, ?', [
               $id,
               $size,
               $path
               
            ]);
        return response()->json([
            'success' => true,
            'message' => 'La el archivo fue se subio correctamente',
            
        ]);
        
    }
}
