@section('titulo', 'Compras')

  @extends('layout.adm-frame')
  @section('compras', 'active')
  @section('content')
    <h1 class="h1 mb-4">Compras</h1>
    <a class="btn btn-indigo mb-4" href="{{ route('adm.compra.create') }}">Nova</a>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Produto</th>
                <th scope="col">Fornecedor</th>
                <th scope="col">Quantidade</th>
                <th scope="col">Preço uni.</th>
                <th scope="col">Data de Vencimento</th>
                <th scope="col">Data</th>
                <th scope="col">Preço total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compras as $compra)
                    <tr>
                        <th scope="row">{{ $compra->id_compra }}</th>
                        <td>{{ $compra->produto->nome_produto}}</td>
                        <td>{{ $compra->fornecedor->nome_fornecedor}}</td>
                        <td>{{ $compra->qntd_compra }}</td>
                        <td>R$ {{ $compra->preco_uni_compra }}</td>
                        <td>{{ $compra->data_venc }}</td>
                        <td>{{ $compra->data_compra }}</td>
                        <td>R$ {{ $compra->preco_uni_compra * $compra->qntd_compra }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  @endsection