<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use App\Models\Estoque;
use App\Models\Compra;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::all();
        return view('adm.produto.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('adm.produto.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Produto::create($request->all());
        return redirect()->back()->with('message', 'Cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        return view('adm.produto.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_produto)
    {
        $produto = Produto::findOrFail($id_produto);
        $categorias = Categoria::all();
        return view('adm.produto.edit', compact('produto', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_produto)
    {
        $produto = Produto::findOrFail($id_produto);
        if($request->method() == 'GET'){
            return view('adm.produto.edit', compact('produto'));
        } else {
            $produto->update($request->all());
        }    
        return redirect()->route('adm.produto.index')->with('message', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_produto)
    {
        Compra::where('id_produto', $id_produto)->delete();

        $produto = Produto::find($id_produto);
        if ($produto) {
            $produto->delete();
            return redirect()->route('adm.produto.index')->with('message', 'Deletado com sucesso!');
        } else {
            return redirect()->route('adm.produto.index')->with('error', 'Produto não encontrado!');
        }
    }
}
