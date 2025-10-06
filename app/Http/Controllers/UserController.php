<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::query(); // Inicia a query builder

        $users->when($request->search, function ($query, $search) { // Aplica o filtro de busca se houver
            $query->where(function ($q) use ($search) { // usamos o use para passar a variável $search para dentro da closure
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        });

        $users = $users->paginate(); // Pagina os resultados, 15 por padrão

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
        Gate::authorize('edit', User::class); // Verifica se o usuário autenticado tem permissão para editar usuários

        $user = User::findOrFail($id);
        $roles = Role::all();

        $user->load('profile', 'interests');
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Gate::authorize('edit', User::class);

        $user = User::findOrFail($id);


        $input = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id, // Ignora o email do usuário atual na verificação de unicidade
            'password' => 'exclude_if:password,null|string|min:8' // Exclui a validação se a senha não foi alterada
        ]);

        $user->update($input);
        return redirect()->route('users.index')->with('status', 'Usuário atualizado com sucesso!'); // redireciona para a lista de usuários com uma mensagem de sucesso
    }

    public function updateProfile(Request $request, string $id)
    {
        Gate::authorize('edit', User::class);

        $input = $request->validate([
            'type' => 'required',
            'address' => 'nullable'
        ]);

        UserProfile::updateOrCreate(
            ['user_id' => $id], // critério de busca
            $input
        );

        return redirect()->route('users.index')->with('status', 'Perfil atualizado com sucesso!');
    }

    public function updateInterests(Request $request, string $id)
    {
        Gate::authorize('edit', User::class);

        $user = User::findOrFail($id);

        $input = $request->validate([
            'interests' => 'nullable|array',
        ]);

        $user->interests()->delete(); // Remove interesses antigos

        if (!empty($input['interests'])) {
            $user->interests()->createMany($input['interests']); // Adiciona os novos interesses
        }

        return redirect()->route('users.index')->with('status', 'Interesses atualizados com sucesso!');
    }

    public function updateRoles(Request $request, string $id)
    {
        Gate::authorize('edit', User::class);

        $user = User::findOrFail($id);
        $input = $request->validate([
            'roles' => 'required|array',
        ]);
        $user->roles()->sync($input['roles']);


        return back()->with('status', 'Cargo atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('destroy', User::class);

        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('status', 'Usuário excluído com sucesso!'); // redireciona para a lista de usuários com uma mensagem de sucesso
    }
}
