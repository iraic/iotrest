<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //REST para el CRUD del modelo Usuarios

    //Consultar todos los usuarios, por paginación
    public function index(Request $request)
    {
        $users = User::paginate(10);
        return response()->json($users, 200);
    }

    //Consultar un usuario por su id
    public function show($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json($user, 200);
        } else {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    }

    //Crear un usuario
    public function store(Request $request)
    {
        //validar si el username ya existe
        $this->validate($request, [
            'username' => 'required|unique:users',
            'password' => 'required',
            'rol' => 'required'
        ]);

        $user = new User;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->rol = $request->rol;
        $user->save();
        return response()->json($user, 201);
    }

    //Actualizacion completa de usuario
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json(['message' => 'Not Found'], 404);
        }
        $this->validate($request, [
            'username' => 'required|unique:users,username,'.$id,
            'password' => 'required',
            'rol' => 'required'
        ]);
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->rol = $request->rol;
        $user->save();
        return response()->json($user, 200);
    }

    //Actualizacion parcial de usuario
    public function updatePartial(Request $request, $id)
    {

        $user = User::find($id);
        if(!$user){
            return response()->json(['message' => 'Not Found'], 404);
        }
        $user->fill($request->all());
        if($request->password) $user->password = Hash::make($request->password);
        $user->save();
        return response()->json($user, 200);
    }

    //Eliminar un usuario
    public function destroy($id)
    {
        $user = User::find($id);
        if(!$user){
            return response()->json(['message' => 'Not Found'], 404);
        }
        $user->delete();
        return response('', 204);
    }

}
