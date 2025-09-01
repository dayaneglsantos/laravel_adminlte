<div class='card'>
    <form action="{{ route('users.updateProfile', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-header">Perfil</div>

        <div class="card-body">
            <div class="form-group mb-2">
                <label for="name">Tipo</label>
                <select class="form-control" id="type" name="type" @error('type') is-invalid @enderror
                    value="{{ old('type', $user->profile->type) }}">
                    @foreach (['PJ', 'PF'] as $type)
                        <option value="{{ $type }}" @selected(old('type', $user->profile->type) == $type)>
                            {{ $type }}
                        </option>
                    @endforeach
                </select>
                @error('type')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group mb-2">
                <label for="address">Endereço</label>
                <input type="text" class="form-control" id="address" aria-describedby="addressHelp"
                    placeholder="Digite seu endereço" name="address"
                    value="{{ old('address', $user->profile->address) }}" @error('address') is-invalid @enderror>
                @error('address')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>
</div>
