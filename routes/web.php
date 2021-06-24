<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\logAcessoMiddleware;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\ContatoController;

Route::post('/contato', 'ContatoController@salvar')->name('site.contato');

// Route::middleware(logAcessoMiddleware::class)
//     ->get('/', 'PrincipalController@principal')
//     ->name('site.index');

Route::get('/', 'PrincipalController@principal')->name('site.index');

// Route::get('/contato', [ContatoController::class, 'contato'])->name('site.contato')->middleware(logAcessoMiddleware::class);

Route::get('/contato', [ContatoController::class, 'contato'])->name('site.contato');

Route::get('/sobre-nos', 'SobreNosController@sobrenos')->name('site.sobrenos');

Route::get('/login/{erro?}', 'LoginController@index')->name('site.login');
Route::post('/login', 'LoginController@autenticar')->name('site.login');

// Route::prefix('/app')->group(function(){
//     Route::middleware('log.acesso', 'autenticacao')
//         ->get('/clientes', function(){return 'Clientes'; })
//         ->name('app.clientes');
    
//     Route::middleware('log.acesso', 'autenticacao')
//         ->get('/fornecedor', 'FornecedorController@index' )
//         ->name('app.fornecedor');
    
//     Route::middleware('log.acesso', 'autenticacao')
//         ->get('/prudutos', function(){return 'Produtos'; })
//         ->name('app.produtos');
// }); 

//  OU 

Route::middleware('autenticacao:padrao,visitante')
    ->prefix('/app')
    ->group(function () {
        Route::get('/home', 'HomeController@index')->name('app.home');
        Route::get('/sair', 'LoginController@sair')->name('app.sair');
        // Route::get('/cliente', 'ClienteController@index')->name('app.cliente');
        
        // fornecedor
        Route::get('/fornecedor', 'FornecedorController@index' )->name('app.fornecedor');
        Route::get('/fornecedor/adicionar', 'FornecedorController@adicionar' )->name('app.fornecedor.adicionar');
        Route::post('/fornecedor/adicionar', 'FornecedorController@adicionar' )->name('app.fornecedor.adicionar');
        Route::post('/fornecedor/listar', 'FornecedorController@listar' )->name('app.fornecedor.listar');
        Route::get('/fornecedor/listar', 'FornecedorController@listar' )->name('app.fornecedor.listar');
        Route::get('/fornecedor/editar/{id}/{msg?}' ,'FornecedorController@editar' )->name('app.fornecedor.editar');
        Route::get('/fornecedor/excluir/{id}' ,'FornecedorController@excluir' )->name('app.fornecedor.excluir');
        
        // produto
        Route::resource('produto', 'ProdutoController');
        
        // produto Detalhe
        Route::resource('produto-detalhe', 'ProdutoDetalheController');

        Route::resource('cliente', 'ClienteController');
        Route::resource('pedido', 'PedidoController');
        // Route::resource('pedido-produto', 'PedidoProdutoController');
        Route::get('pedido-produto/create/{pedido}', 'PedidoProdutoController@create')->name('pedido-produto.create');
        Route::post('pedido-produto/store/{pedido}', 'PedidoProdutoController@store')->name('pedido-produto.store');
        Route::delete('pedido-produto.destroy/{pedidoProduto}/{pedido_id}', 'PedidoProdutoController@destroy')->name('pedido-produto.destroy');
    }
);


Route::get('/rota1', function(){
    echo 'rota 1';
})->name('site.rota1');

Route::get('/rota2', function(){
    return redirect()->route('site.rota1');
})->name('site.rota2');
//          OU
//Route::redirect('/rota2', '/rota1');

Route::fallback(function(){
    echo 'A Rota acessada não existe. <a href="'.route('site.index').'">Clique aqui</a> para ir para Pagina inicial';
});

Route::get('/teste/{p1}/{p2}', 'TesteController@teste')->name('site.teste');


// Route::get($uri, $callback)
// Route::get('/contato/{nome}/{categoria_id}', 
// function(
//     string $nome = "Desconhecido", 
//     int $categoria_id = 1
// ){
//     echo "Estamos aqui: $nome - $categoria_id";
// }
// )->where('categoria_id','[0-9]+')
//  ->where('nome', '[A-Za-z]+'); //verificar parametros recebidos

// Route::get('/', function () {
//     return view('welcome');
// });

/*
Verbo http
get
post
put
patch
delete
options
*/