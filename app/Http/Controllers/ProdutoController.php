<?php

namespace App\Http\Controllers;

use App\Fornecedor;
use App\Produto;
use App\Unidade;
use App\ProdutoDetalhe;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $produtos = Produto::with('produtoDetalhe','fornecedor','pedidos')->paginate(3); //get();
        /*
        foreach ($produtos as $key => $produto) {
            $produtoDetalhe = ProdutoDetalhe::where('produto_id', '=', $produto->id)->first();

            if (isset($produtoDetalhe)) {
                // print_r($produtoDetalhe->getAttributes());
                $produtos[$key]['comprimento'] = $produtoDetalhe->comprimento;
                $produtos[$key]['altura'] = $produtoDetalhe->altura;
                $produtos[$key]['largura'] = $produtoDetalhe->largura;
            }
        }
        */
        return view('app.produto.index', ['produtos' => $produtos, 'request' => $request->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fornecedores = Fornecedor::all();
        $unidades = Unidade::all();
        return view('app.produto.create', compact('unidades','fornecedores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:40',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id',
            'fornecedor_id' => 'exists:fornecedores,id'
        ];
        $feedback = [
            'required' => 'O campo:attribute deve ser preenchido',
            'fornecedor_id.exists' => 'Selecione o negocio ai'
           
        ];

        $request->validate($regras);

        Produto::create($request->all());
        return redirect()->route('produto.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        return view('app.produto.show', ['produto' => $produto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Produto $produto)
    {
        $fornecedores = Fornecedor::all();
        $unidades = Unidade::all();
        return view('app.produto.edit', ['produto' => $produto, 'unidades' => $unidades, 'fornecedores' => $fornecedores]);
    }

    /**
     * Update the specified resource in storage. 
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto) //put => tudo, patch => parcial
    {
        // echo 'request: <pre>'.print_r($request->all(),1).'</pre>';               request -> novas informações
        // echo 'Produto: <pre>'.print_r($produto->getAttributes(),1).'</pre>';     produto -> informações que serão substituidas

        $regras = [
            'nome' => 'required|min:3|max:40',
            'descricao' => 'required|min:3|max:40',
            'peso' => 'required|integer',
            'unidade_id' => 'exists:unidades,id',
            'fornecedor_id' => 'exists:fornecedores,id'
        ];
        $request->validate($regras);
        
        $produto->update($request->all());
        return redirect()->route('produto.show', ['produto' => $produto->id ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        Produto::find($produto->id)->delete();
        return redirect()->route('produto.index');  
    }
}
