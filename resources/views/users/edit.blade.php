@extends('layouts.default')
@section('page-title', 'Editar Usuário')

@section('content')
    @include('users.parts.basic-infos')
    <br>
    @include('users.parts.profile')
@endsection
