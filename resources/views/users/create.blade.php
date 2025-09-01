@extends('layouts.default')
@section('page-title', 'Criar Usuário')

@section('content')
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Digite seu nome"
                name="name" value="{{ old('name') }}" @error('name') is-invalid @enderror>
            @error('name')
                <small class="invalid-feedback">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                placeholder="Digite seu email" name="email" value="{{ old('email') }}"
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

        </div>


        <button type="submit" class="btn btn-primary mt-3">Criar</button>
    </form>
@endsection
