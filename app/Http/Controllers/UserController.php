<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    // Listar todos os usuários
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    // Mostrar o formulário para criar um novo usuário (para aplicações web)
    public function store()
    {
        // Retorna a view para criar um novo usuário
    }

    // Armazenar um novo usuário
    public function create(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return response()->json("Usuario criado com sucesso!", 201);
}


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(compact('token'));
    }

    // Mostrar um usuário específico
    public function show(User $user)
    {
        return response()->json($user);
    }

    // Mostrar o formulário para editar um usuário (para aplicações web)
    public function edit(User $user)
    {
        // Retorna a view para editar o usuário
    }

    // Atualizar um usuário específico
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'sometimes|required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user->update([
            'name' => $request->input('name', $user->name),
            'email' => $request->input('email', $user->email),
            'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
        ]);

        return response()->json($user);
    }

    // Remover um usuário específico
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(null, 204);
    }
}
