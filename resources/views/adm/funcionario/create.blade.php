@section('titulo', 'Cadastro de Funcionario')

  @extends('layout.adm-frame')
  @section('funcionarios', 'active')
  @section('content')
    <h1 class="h1 my-4 text-center">Cadastro de Funcionario</h1>
    <input type="text" class="form-control mb-2" id="data-nasc" placeholder="Nome">
    <div class="input-group mb-2">
        <span class="input-group-text">@</span>
        <input type="email" class="form-control" id="data-nasc" placeholder="E-mail">
    </div>
    <input type="password" class="form-control mb-2" id="data-nasc" placeholder="Senha">
    
    <div class="d-grid d-md-flex gap-2 my-4 justify-content-md-end">
        <a type="button" class="btn btn-outline-danger" href="{{ route('adm.produto') }}">Cancelar</a>
        <button class="btn btn-indigo" type="submit">Cadastrar</button>
    </div>
  @endsection