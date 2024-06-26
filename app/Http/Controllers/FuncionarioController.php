<?php

namespace App\Http\Controllers;

use App\Http\Requests\FuncionarioRequest;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FuncionarioController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $funcionarios = Funcionario::all();
        return view('adm.funcionario.index', compact('funcionarios'));
    }

    public function login() {
        if(Auth::guard('admin')->check()) {
            return redirect()->route('adm.home');
        } else {
            return view('adm.funcionario.login');
        }
    }

    public function autentica(Request $request) {
        date_default_timezone_set('America/Sao_Paulo');
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ],
        [
            'email.required' => 'O campo email é obrigatório',
            'email.email' => 'O campo email deve ser um email válido',
            'password.required' => 'O campo senha é obrigatório',
        ]);
 
        if (Auth::guard('admin')->attempt($credentials)) {
            $data = [
                'id_func' => Auth::guard('admin')->user()->id,
                'data_login' => date('y-m-d  H:i:s')
            ];

            DB::table('logins')->insertGetId($data);
            $request->session()->regenerate();
            return redirect()->route('adm.home');
        }
        
        flash('Email ou senha incorretos!', 'error', [], 'Erro');
        return back();
    }

    public function logout(Request $request) {
        Auth::guard('admin')->logout();
     
        return redirect()->route('main.home');
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
    public function store(FuncionarioRequest $request) {
        Funcionario::create([
            'nome_func' => $request -> nome_func,
            'email' => $request -> email,
            'password' => Hash::make($request -> password),
        ]);
        flash('Funcionário cadastrado com sucesso!', 'success', [], 'Sucesso');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id) {
        $funcionario = Funcionario::findOrFail($id);
        return view('adm.funcionario.edit' , compact('funcionario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FuncionarioRequest $request, $id) {
        $id = Funcionario::findOrFail($id);
        $id->update([
            'nome_func' => $request -> nome_func,
            'email' => $request -> email,
            'password' => Hash::make($request -> password),
        ]);
        flash('Funcionário atualizado com sucesso!', 'success', [], 'Sucesso');
        return redirect()->route('adm.funcionario.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {
        $funcionario = Funcionario::findOrFail($id);
        $funcionario->delete();
        flash('Funcionário deletado com sucesso!', 'success', [], 'Sucesso');
        return redirect()->route('adm.funcionario.index');
    }

    public function pesquisa(Request $request) {
        $query = $request->input('query');
        $funcionarios = Funcionario::where('nome_func', 'like', '%' . $query . '%')->get();
        return view('adm.funcionario.index', compact('funcionarios'));
    }
}
