@section('titulo', 'Funcionarios')

  @extends('layout.adm-frame')
  @section('funcionarios', 'active')
  @section('content')
    <h1 class="h1 mb-4">Funcionarios</h1>
    <a class="btn btn-indigo mb-4" href="{{ route('adm.funcionario.create') }}">Novo</a>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($funcionarios as $funcionario)
                    <tr>
                        <th scope="row">{{ $funcionario->id_func }}</th>
                        <td>{{ $funcionario->nome_func }}</td>
                        <td>{{ $funcionario->email_func }}</td>
                        <td>
                            <a href="#" class="btn btn-success mb-1 mb-md-0">Editar</a>
                            <form action="#" method="post" style="display: inline;">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger mb-1 mb-md-0" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                            </form>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  @endsection