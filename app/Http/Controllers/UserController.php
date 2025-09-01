<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users')); // se houvessem mais variáveis, poderiam ser adicionadas no compact e elas estariam disponíveis na view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        User::create($input);
        return redirect()->route('users.index')->with('status', 'Usuário criado com sucesso!'); // redireciona para a lista de usuários com uma mensagem de sucesso
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $input = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id, // Ignora o email do usuário atual na verificação de unicidade
            'password' => 'exclude_if:password,null|string|min:8' // Exclui a validação se a senha não foi alterada
        ]);

        $user->update($input);
        return redirect()->route('users.index')->with('status', 'Usuário atualizado com sucesso!'); // redireciona para a lista de usuários com uma mensagem de sucesso
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('status', 'Usuário excluído com sucesso!'); // redireciona para a lista de usuários com uma mensagem de sucesso
    }
}
