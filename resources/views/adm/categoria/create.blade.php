@section('titulo', 'Nova Categoria')

  @extends('layout.adm-frame')
  @section('categorias', 'active')
  @section('content')
    <h1 class="h1 my-4 text-center">Nova Categoria</h1>
    <input type="text" class="form-control mb-2" id="nome" placeholder="Nome">
    <div class="d-grid d-md-flex gap-2 my-4 justify-content-md-end">
        <a type="button" class="btn btn-outline-danger" href="{{ route('adm.produto') }}">Cancelar</a>
        <button class="btn btn-indigo" type="submit">Cadastrar</button>
    </div>
  @endsection