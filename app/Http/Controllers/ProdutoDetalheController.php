<?php

namespace App\Http\Controllers;
use App\Unidade;
use App\ProdutoDetalhe;

use Illuminate\Http\Request;

class ProdutoDetalheController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unidades = Unidade::all();
        return view('app.produto_detalhe.create', ['unidades' => $unidades]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $val = ProdutoDetalhe::create($request->all());
        echo ($val) ? 'deu certo' : 'deu não';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\ProdutoDetalhe $produtoDetalhe
     * @return \Illuminate\Http\Response
     */
    public function edit(ProdutoDetalhe $produtoDetalhe) 
    {
        $produtoDetalhe = ProdutoDetalhe::with('produto')->find($produtoDetalhe->id);
        $unidades = Unidade::all();
        return view('app.produto_detalhe.edit', ['produto_detalhe' => $produtoDetalhe, 'unidades' => $unidades]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\ProdutoDetalhe $produtoDetalhe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProdutoDetalhe $produtoDetalhe)
    {
        $produtoDetalhe->update($request->all());
        // return view('app.produto_detalhe.create');
        return Response($produtoDetalhe ? 'Update realizado com sucesso!' : 'Error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
