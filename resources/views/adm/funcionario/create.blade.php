@section('titulo', 'Cadastro de Funcionario')

@extends('layout.adm-frame')
@section('funcionarios', 'active')
@section('content')
    <form action="{{ route('adm.funcionario.store') }}" method="POST">
        @csrf
        <h1 class="h1 my-4 text-center">Cadastro de Funcionario</h1>
        <input type="text" class="form-control mb-2" name="nome_func" placeholder="Nome" value="{{ old('nome_func') }}">
        <div class="input-group mb-2">
            <span class="input-group-text">@</span>
            <input type="email" class="form-control" name="email" placeholder="E-mail" value="{{ old('email') }}">
        </div>
        <input type="password" class="form-control mb-2" name="password" placeholder="Senha">
        @error('nome_func')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="d-grid d-md-flex gap-2 my-4 justify-content-md-end">
            <a type="button" class="btn btn-outline-danger" href="{{ route('adm.funcionario.index') }}">Cancelar</a>
            <button class="btn btn-indigo" type="submit">Cadastrar</button>
        </div>
    </form>
@endsection
