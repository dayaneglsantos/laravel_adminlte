<div class='card'>
    <form action="{{ route('users.updateRoles', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-header">Cargos</div>

        <div class="card-body">
            @foreach ($roles as $role)
                <div class="form-check">
                    <input class="form-check-input @error('roles') is-invalid @enderror" type="checkbox"
                        value="{{ $role->id }}" name="roles[]" @checked(in_array($role->name, $user->roles->pluck('name')->toArray()))>
                    {{-- verifica se o item atual do loop está dentro do array de interesses do usuário --}}
                    <label class="form-check-label" for="defaultCheck2">
                        {{ $role->name }}
                    </label>
                </div>
                @if ($loop->last)
                    @error('roles')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                @endif
            @endforeach
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
</div>
