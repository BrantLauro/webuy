<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\FuncionarioController;
use Illuminate\Support\Facades\Auth;

use App\Models\Categoria;

// rotas da Main

Route::get('/', [ProdutoController::class, 'home'])->name('main.home');

Route::get('/{categoria}', [CategoriaController::class, 'filtro'])->name('produto.filtro')->whereNumber('categoria');

Route::post('/{home}', [ProdutoController::class, 'pesquisa'])->name('produto.pesquisa')->whereNumber('home');

Route::get('/sobre', function () {
    $categorias = Categoria::all();
    $cliente = Auth::id();
    return view('main.sobre', compact('categorias', 'cliente'));
})->name('main.sobre');

Route::get('/login', [ClienteController::class, 'login'])->name('cliente.login');

Route::post('/login', [ClienteController::class, 'autentica'])->name('cliente.login.autentica');

Route::get('/logout', [ClienteController::class, 'logout'])->name('cliente.logout');

Route::get('/cadastro', [ClienteController::class, 'create'])->name('cliente.cadastro');

Route::post('/cadastro', [ClienteController::class, 'store'])->name('cliente.store');

Route::get('/perfil', [ClienteController::class, 'show'])->name('cliente.perfil');

Route::get('/editar', [ClienteController::class, 'edit'])->name('cliente.edit');

Route::post('/editar/{id}', [ClienteController::class, 'update'])->name('cliente.update');

Route::delete('/perfil', [ClienteController::class, 'destroy'])->name('cliente.delete');

Route::get('/carrinho', [CarrinhoController::class, 'show'])->name('cliente.carrinho');

Route::delete('/carrinho/{id_produto}', [CarrinhoController::class, 'deletarProduto'])->name('cliente.carrinho.delete');

Route::get('/carrinho/{id_produto}/{qnt}', [CarrinhoController::class, 'adicionar'])->name('cliente.carrinho.add');

Route::get('/pagamento', [VendaController::class, 'create'])->name('cliente.pagamento');

Route::post('/pagamento', [VendaController::class, 'store'])->name('cliente.pagamento.store');

Route::get('/editar/mudar-senha', [ClienteController::class, 'mudarSenha'])->name('cliente.mudar-senha');

Route::post('/cliente/update-senha', [ClienteController::class, 'updateSenha'])->name('cliente.update-senha');

Route::get('/cliente/minhas-compras', [ClienteController::class, 'minhasCompras'])->name('cliente.compras');

// rotas da ADM


Route::prefix('adm')->name('adm.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('adm.produto.index');
    })->name('home');

    Route::get('/login', [FuncionarioController::class, 'login'])->name('login');

    Route::post('/login', [FuncionarioController::class, 'autentica'])->name('login.autentica');

    Route::middleware('check.admin')->group(function () {
        Route::get('/logout', [FuncionarioController::class, 'logout'])->name('logout');

        Route::group(['prefix' => 'produto', 'as' => 'produto.'], function () {
            Route::get('/', [ProdutoController::class, 'index'])->name('index');
            Route::post('/{home}', [ProdutoController::class, 'pesquisa'])->name('pesquisa')->whereNumber('home');
            Route::get('/novo', [ProdutoController::class, 'create'])->name('create');
            Route::post('/novo', [ProdutoController::class, 'store'])->name('store');
            Route::get('/editar/{id}', [ProdutoController::class, 'edit'])->name('edit');
            Route::post('/editar/{id}', [ProdutoController::class, 'update'])->name('update');
            Route::delete('/{id}', [ProdutoController::class, 'destroy'])->name('delete');
        });

        Route::group(['prefix' => 'categoria', 'as' => 'categoria.'], function () {
            Route::get('/', [CategoriaController::class, 'index'])->name('index');
            Route::post('/', [CategoriaController::class, 'pesquisa'])->name('pesquisa');
            Route::get('/novo', [CategoriaController::class, 'create'])->name('create');
            Route::post('/novo', [CategoriaController::class, 'store'])->name('store');
            Route::get('/editar/{id}', [CategoriaController::class, 'edit'])->name('edit');
            Route::post('/editar/{id}', [CategoriaController::class, 'update'])->name('update');
            Route::delete('/{id}', [CategoriaController::class, 'destroy'])->name('delete');
        });

        Route::group(['prefix' => 'compra', 'as' => 'compra.'], function () {
            Route::get('/', [CompraController::class, 'index'])->name('index');
            Route::post('/', [CompraController::class, 'pesquisa'])->name('pesquisa');
            Route::get('/novo', [CompraController::class, 'create'])->name('create');
            Route::post('/novo', [CompraController::class, 'store'])->name('store');
        });

        Route::group(['prefix' => 'venda', 'as' => 'venda.'], function () {
            Route::get('/', [VendaController::class, 'index'])->name('index');
            Route::post('/', [VendaController::class, 'pesquisa'])->name('pesquisa');
        });

        Route::group(['prefix' => 'fornecedor', 'as' => 'fornecedor.'], function () {
            Route::get('/', [FornecedorController::class, 'index'])->name('index');
            Route::post('/', [FornecedorController::class, 'pesquisa'])->name('pesquisa');
            Route::get('/novo', [FornecedorController::class, 'create'])->name('create');
            Route::post('/novo', [FornecedorController::class, 'store'])->name('store');
            Route::get('/editar/{id}', [FornecedorController::class, 'edit'])->name('edit');
            Route::post('/editar/{id}', [FornecedorController::class, 'update'])->name('update');
            Route::delete('/{id}', [FornecedorController::class, 'destroy'])->name('delete');
        });

        Route::group(['prefix' => 'funcionario', 'as' => 'funcionario.'], function () {
            Route::get('/', [FuncionarioController::class, 'index'])->name('index');
            Route::post('/', [FuncionarioController::class, 'pesquisa'])->name('pesquisa');
            Route::get('/novo', [FuncionarioController::class, 'create'])->name('create');
            Route::post('/novo', [FuncionarioController::class, 'store'])->name('store');
            Route::get('/editar/{id}', [FuncionarioController::class, 'edit'])->name('edit');
            Route::post('/editar/{id}', [FuncionarioController::class, 'update'])->name('update');
            Route::delete('/{id}', [FuncionarioController::class, 'destroy'])->name('delete');
        });
    });
});
