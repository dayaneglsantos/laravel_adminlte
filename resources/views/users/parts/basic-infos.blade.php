<div class='card'>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-header">Dados básicos</div>
        <div class="card-body">
            <div class="form-group mb-2">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" aria-describedby="nameHelp"
                    placeholder="Digite seu nome" name="name" value="{{ old('name', $user->name) }}"
                    @error('name') is-invalid @enderror>
                @error('name')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                    placeholder="Digite seu email" name="email" value="{{ old('email', $user->email) }}"
                    @error('email') is-invalid @enderror>
                @error('email')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Digite sua senha"
                    name="password">
                @error('password')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
</div>
