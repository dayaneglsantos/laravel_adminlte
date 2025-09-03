<div class='card'>
    <form action="{{ route('users.updateInterests', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="card-header">Interesses</div>

        <div class="card-body">
            @foreach (['Futebol', 'Basquete', 'Academia'] as $item)
                <div class="form-check">
                    <input class="form-check-input @error('interests') is-invalid @enderror" type="checkbox"
                        value="{{ $item }}" name="interests[][name]" @checked(in_array($item, $user->interests->pluck('name')->toArray()))>
                    {{-- verifica se o item atual do loop está dentro do array de interesses do usuário --}}
                    <label class="form-check-label" for="defaultCheck2">
                        {{ $item }}
                    </label>
                </div>
                @if ($loop->last)
                    @error('interests')
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
