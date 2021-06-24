@extends('app.layouts.basico')

@section('titulo', 'Produto Detalhe')
   
@section('conteudo')

    
    <div class="conteudo-pagina">
        
        <div class="titulo-pagina-2">
            <p>Editar Detalhes do Produto</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href='#'>Voltar</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            {{ $produto_detalhe->toJson() }}
            <h4>Produto</h4>
            <div>Nome: {{ $produto_detalhe->produto->nome ?? ''}}</div>
            <br>
            <div>Descrição: {{ $produto_detalhe->produto->descricao ?? ''}}</div>
            <br>
            {{-- {{ $produto_detalhe->toJson() }} --}}
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                @component('app.produto_detalhe._components.form_create_edit', ['produto_detalhe' => $produto_detalhe, 'unidades' => $unidades])  
                @endcomponent
            </div>
        </div>
    </div>
@endsection