@extends('layouts.default')
@section('page-title', 'Usuários')

@section('page-action')
    <a href="{{ route('users.create') }}" class="btn btn-primary">Adicionar Usuário</a>
@endsection

@section('content')
    @session('status')
        <div class="alert alert-success">{{ $value }}</div>
    @endsession

    <form action="{{ route('users.index') }}" method="GET" class="mb-3" style="width: 500px;">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar por nome ou email"
                value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>

    </form>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @can('edit', $user)
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-primary">Editar</a>
                        @endcan
                        @can('destroy', $user)
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                            </form>
                        @endcan

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
@endsection
