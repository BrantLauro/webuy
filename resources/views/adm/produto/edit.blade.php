@section('titulo', 'Editar Produto')

@extends('layout.adm-frame')
@section('produtos', 'active')
@section('content')
    <form action="{{ route('adm.produto.update', $produto->id_produto) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h1 class="h1 my-4 text-center">Editar Produto</h1>
        <div class="row g-2">
            <div class="col-md-7 col-sm-12">
                <input type="text" class="form-control mb-2" name="nome_produto" value="{{ $produto->nome_produto }}"
                    placeholder="Nome">
                <input type="file" class="form-control" name="foto_produto" value="{{ $produto->foto_produto }}">
            </div>
            <div class="col-md col-sm-12">
                <select name="id_categoria" class="form-select mb-2">
                    <option value="">Escolha uma opção</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id_categoria }}" {{ $produto->categoria->id_categoria ?? '' == $categoria->id_categoria ? 'selected' : '' }}>{{ $categoria->nome_categoria }}</option>
                    @endforeach
                </select>
                <div class="input-group mb-2">
                    <span class="input-group-text">R$</span>
                    <input type="number" class="form-control" name="preco_produto" value="{{ $produto->preco_produto }}" step="0.01" placeholder="Preço">
                </div>

            </div>
        </div>
        <div class="input-group mb-2">
            <span class="input-group-text">Descrição</span>
            <textarea class="form-control form-control-lg" aria-label="With textarea" name="desc_produto">{{ $produto->desc_produto }}</textarea>
        </div>
        @error('nome_produto')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('foto_produto')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('id_categoria')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('preco_produto')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="d-grid d-md-flex gap-2 my-4 justify-content-md-end">
            <a type="button" class="btn btn-outline-danger" href="{{ route('adm.produto.index') }}">Cancelar</a>
            <button class="btn btn-indigo" type="submit">Salvar Alterações</button>
        </div>
    </form>
@endsection
