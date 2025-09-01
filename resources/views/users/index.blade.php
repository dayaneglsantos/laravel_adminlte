@extends('layouts.default')
@section('page-title', 'Usuários')

@section('page-action')
    <a href="{{ route('users.create') }}" class="btn btn-primary">Adicionar Usuário</a>
@endsection

@section('content')
    @session('status')
        <div class="alert alert-success">{{ $value }}</div>
    @endsession
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
                        <a class="btn btn-sm btn-primary">Editar</a>
                        <a class="btn btn-sm btn-danger">Excluir</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
