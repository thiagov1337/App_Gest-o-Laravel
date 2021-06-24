<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pedido;
use App\Produto;
use App\PedidoProduto;

class PedidoProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Pedido $pedido)
    {
        $produtos = Produto::all();
        $pedido->produtos; //eager loading
        return view('app.pedido_produto.create', ['pedido' => $pedido, 'produtos' => $produtos ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Pedido $pedido)
    {
        
        $regras = [
            'produto_id' => 'exists:produtos,id',
            'quantidade' => 'required|min:1'
        ];
        
        $request->validate($regras);
        /*
        $pedidoProduto = new PedidoProduto();
        $pedidoProduto->pedido_id = $pedido->id;
        $pedidoProduto->produto_id = $request->produto_id; 
        $pedidoProduto->quantidade = $request->quantidade; 
        $pedidoProduto->save();
        */

        //$pedido->produtos; // os registros do relacionamento
        //$pedido->produtos(); // objeto
        /*
        $pedido->produtos()->attach(
            $request->get('produto_id'),
            ['quantidade' => $request->quantidade]
        );
        */

        $pedido->produtos()->attach([
          $request->produto_id => ['quantidade' => $request->quantidade]  
        ]);

        return redirect()->route('pedido-produto.create', ['pedido' => $pedido->id]);

        // echo "<pre>";
        // print_r($pedido->id); 
        // echo "</pre>";
        // echo "<hr>";
        // echo "<pre>";
        // print_r($request->produto_id);
        // echo "</pre>";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PedidoProduto  $pedidoProduto
     * @param  int $pedido_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PedidoProduto $pedidoProduto, $pedido_id)
    {
        // PedidoProduto::where([
        //     'pedido_id' => $pedido->id,
        //     'produto_id' => $produto->id
        // ])->delete();

        //$pedido->produtos()->detach($produto->id);
        // $produto->produtos()->detach($pedido->id);
        //$pedidoProduto->produtos()->detach($pedidoProduto->id);

        $pedidoProduto->delete();

        return redirect()->route('pedido-produto.create', ['pedido' => $pedido_id]);
    }
}
