<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FormularioController extends Controller
{
    //
    public function generarLink()
    {
        $token = Str::random(40);
        return response()->json([
            'link' => url("/admin/formulario/$token"),
            'token' => $token
        ]);
    }

    // Muestra el formulario público
    public function mostrar($token)
    {
        return view('admin/formulario/formulario_publico', ['token' => $token]);
    }

    // Guarda usando Stored Procedure
    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellidoP' => 'required',
            'apellidoM' => 'required',
        ]);

        DB::statement('EXEC SP_GuardarFormulario @nombre = ?, @apP = ?, @apM = ?', [
            $request->nombre,
            $request->apellidoP,
            $request->apellidoM,
        ]);

        return response()->json(['success' => true, 'message' => 'Formulario enviado correctamente']);
    }
}
