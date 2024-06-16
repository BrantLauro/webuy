<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaoRequest;
use App\Models\Categoria;
use Illuminate\Http\Request;
use ILLuminate\Database\QueryException;
use App\Models\Produto;
use App\Http\Requests\CategoriaRequest;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();
        return view('adm.categoria.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('adm.categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriaRequest $request)
    {
        Categoria::create($request->all());
        return redirect()->back()->with('message', 'Cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_categoria)
    {
        $categoria = Categoria::findOrFail($id_categoria);
        return view('adm.categoria.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriaRequest $request, $id_categoria)
    {
        $categoria = Categoria::findOrFail($id_categoria);
        $categoria->update($request->all());
        return redirect()->route('adm.categoria.index')->with('message', 'Categoria atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_categoria)
    {
        Produto::where('id_categoria', $id_categoria)->update(['id_categoria' => null]);

        $categoria = Categoria::findOrFail($id_categoria);
        if($categoria) {
            $categoria->delete();
            return redirect()->route('adm.categoria.index')->with('message', 'Categoria deletada com sucesso!');
        } else {
            return redirect()->route('adm.categoria.index')->with('message', 'Erro ao tentar deletar a categoria.');
        }
    }
}