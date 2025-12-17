<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;


class UserController extends Controller
{
    public function index()
    {
        //
        $users=DB::select('EXEC dbo.ViewUser');
        return view('admin/configuracion/usuerconfiguracion',compact('users'));
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
        // Gate::authorize('create-agregar');
        try {
            $request->validate([
                'name'     => 'required|string|max:50',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                'lastname' => 'required|string|max:50',
                'permiso' => 'required',
            
            ]);
    
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'Tapellidos_user' => $request->lastname,
                'password' => bcrypt($request->password),
            ]);
            $user->assignRole($request->permiso);
            session()->flash('swal',[
                        'icon'=> 'success',
                        'title'=> '!Exito¡',
                        'text'=>'El usuario fue creado correctamente'
                        
                    ]);
            
            return redirect()->route('admin.prueba.nada');

        } catch (ValidationException $e) {
            $errors = implode("\n", $e->validator->errors()->all());
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '!Upss',
                'text' => $errors
            ]);
            return redirect()->route('admin.prueba.nada');
        }


    }
    public function show($id)
    {
        //usaremos el show para habiliar usuarios
        $habilitar= DB::statement('EXEC dbo.HabilitarrUser ? ',[$id]);
        if ($habilitar === true) {
                session()->flash('swal', [
                    'icon' => 'success',
                    'title' => '¡Buen trabajo!',
                    'text' => 'Se Habilito el usuario correctamente'
                ]);
        } else {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'No se habilito el usuario correctamente'
            ]);
        }  
        return redirect()->route('admin.prueba.nada');
    }
    public function eliminar($id)
    {
        //
        $usuario=User::find($id);
        $usuario->delete();
        session()->flash('swal',[
            'icon'=> 'success',
            'title'=> '!Exito¡',
            'text'=>'El usuario fue eliminado correctamente'
                        
        ]);
        return redirect('/admin/Agregar');
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

        if ($request->tipo == 1) {
            
            Log::info('Llega correctamente', ['id' => $id, 'data' => $request->all()]);
            $resultado = DB::statement('EXEC dbo.EditarUser ?,?,?,?', [
                $id,
                $request->nombre,
                $request->apellidos,
                $request->email
            ]);
            $user = User::find($id);
            $user->syncRoles($request->permiso);
            return response()->json(['message' => 'Asistente actualizado correctamente']);
        }
        if ($request->tipo == 4) {
            #para charla
            Log::info('Llega correctamente', ['id' => $id, 'data' => $request->all()]);
            $resultado = DB::statement('EXEC dbo.EditarTipoCharla ?,?,?', [
                $id,
                $request->nombre,
                $request->descripcion,

            ]);
            return response()->json(['message' => 'Charla actualizado correctamente']);
        }
        if ($request->tipo == 5) {
            #para expositor
            Log::info('Llega correctamente', ['id' => $id, 'data' => $request->all()]);
            $resultado = DB::statement('EXEC dbo.EditarExpositor ?,?,?,?,?', [
                $id,
                $request->nombre,
                $request->apP,
                $request->apM,
                $request->celular

            ]);
            return response()->json(['message' => 'Expositor actualizado correctamente']);
        }
        if ($request->tipo == 6) {
            #para especialidades
            Log::info('Llega correctamente', ['id' => $id, 'data' => $request->all()]);
            $resultado = DB::statement('EXEC dbo.EditarTipoEspecie ?,?', [
                $id,
                $request->nombre,

            ]);
            return response()->json(['message' => 'Expositor actualizado correctamente']);
        }
        if ($request->tipo == 3) {
            
            Log::info('Llega correctamente', ['id' => $id, 'data' => $request->all()]);
            $resultado = DB::statement('EXEC dbo.EditarTipoCampaña ?,?,?', [
                $id,
                $request->nombre,
                $request->descripcion,

            ]);
            return response()->json(['message' => 'Campaña actualizado correctamente']);
        } 
        if ($request->tipo == 8) {
            
            Log::info('Llega correctamente', ['id' => $id, 'data' => $request->all()]);
            $resultado = DB::statement('EXEC dbo.EditarColaborador ?,?', [
                $id,
                $request->nombre,

            ]);
            return response()->json(['message' => 'Colaborador actualizado correctamente']);
        }else {

            $request->validate([
                'password' => 'required|string|min:8|confirmed',         
            ]);
            Log::info('Llega correctamente', ['id' => $id, 'data' => $request->all()]);
            $contra= bcrypt($request->password);
            $resultado = DB::statement('EXEC dbo.EditarUserPassword ?,?', [
                $id,
                $contra,
            ]);
            return response()->json(['message' => 'Asistente actualizado correctamente']);
            

        }
        
    }





    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        
        $eliminado= DB::statement('EXEC dbo.EliminarUser ? ',[$id]);
        if ($eliminado === true) {
                session()->flash('swal', [
                    'icon' => 'success',
                    'title' => '¡Buen trabajo!',
                    'text' => 'Se elimino el usuario correctamente'
                ]);
        } else {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => '¡Ups!',
                'text' => 'No elimino el usuario correctamente'
            ]);
        }  
        return redirect()->route('admin.usuarios.index');
    }
}
