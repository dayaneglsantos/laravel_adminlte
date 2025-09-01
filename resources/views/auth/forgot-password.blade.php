@extends('layouts.auth')
@section('body_class', 'login-page')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ route('login') }}"><b>Admin</b>LTE</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Inform your email to receive a password reset link</p>
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form action="{{ route('password.email') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-text"><span class="bi bi-envelope"></span></div>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                            name="email" required value="{{ old('email') }}" />
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Send link</button>
                    </div>


                </form>

                <div class="mt-3 text-center">
                    <p class="mb-1"><a href="{{ route('login') }}">Back to login</a></p>

                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection
