@extends('app.layouts.basico')

@section('titulo', 'Pedido Produto')
   
@section('conteudo')

    
    <div class="conteudo-pagina">
        
        <div class="titulo-pagina-2">
            @if (isset($produto->id))
                <p>Editar Produto ao Pedido</p>
            @else
                <p>Adicionar Produto ao Pedido</p>    
            @endif
        </div>
        <div class="menu">
            <ul>
                <li><a href='{{ route('pedido.create')}}'>Novo</a></li>
                {{-- <li><a href='{{ route('produto.index')}}'>Consultar</a></li> --}}
            </ul>
        </div>

        <div class="informacao-pagina">
            <h4>Detalhes do Pedido</h4>
            <p>ID do Pedido: {{ $pedido->id }} </p>
            <p>Cliente: {{ $pedido->cliente_id }} </p>
            
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <h4>Itens do Pedido</h4>

                <table border="1" width="100%" style="margin: 0 auto;">
                    <thead>
                        <tr>
                            <th>ID</td>
                            <th>Nome do Produto </td>
                            <th>Quantidade</td>
                            <th>Data de Inclusão do item no pedido</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedido->produtos as $produto)
                            <tr>
                                <td>{{ $produto->id }}</td>
                                <td>{{ $produto->nome }}</td>
                                <td>{{ $produto->pivot->quantidade }}</td>
                                <td>{{ $produto->pivot->created_at->format('d/m/Y H:i:s') }}</td>
                                <td>
                                    <form id="form_{{$produto->pivot->id}}" method="POST" action="{{ route('pedido-produto.destroy', ['pedidoProduto' => $produto->pivot->id, 'pedido_id' => $pedido->id ])}}">
                                        @method("DELETE")
                                        @csrf
                                        <a href="#" onclick="document.getElementById('form_{{$produto->pivot->id}}').submit()">Excluir</a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                @component('app.pedido_produto._components.form_create', ['pedido' => $pedido, 'produtos' => $produtos])
                @endcomponent
            </div>
        </div>
    </div>
@endsection