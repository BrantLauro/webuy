<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use Illuminate\Http\Request;

class FuncionarioController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view('adm.funcionario.index');
    }

    public function login() {
        return view('adm.funcionario.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('adm.funcionario.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        Funcionario::create($request->all());
        return redirect()->back()->with('message','Cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Funcionario $funcionario) {
        return view('adm.funcionario.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Funcionario $funcionario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Funcionario $funcionario)
    {
        //
    }
}
