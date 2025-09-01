@extends('layouts.default')
@section('page-title', 'Editar Usuário')

@section('content')
    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        {{-- precisamos colocar o método PUT desta forma pois o HTML não suporta métodos diferentes de GET e POST --}}
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Digite seu nome"
                name="name" value="{{ old('name', $user->name) }}" @error('name') is-invalid @enderror>
            @error('name')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                placeholder="Digite seu email" name="email" value="{{ old('email', $user->email) }}"
                @error('email') is-invalid @enderror>
            @error('email')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Digite sua senha" name="password">
            @error('password')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Criar</button>
        </div>


    </form>
@endsection
