@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')
   
@section('conteudo')

    
    <div class="conteudo-pagina">
        
        <div class="titulo-pagina-2">
            <p>Listagem de Produtos</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href='{{ route('produto.create')}}'>Novo</a></li>
                {{-- <li><a href='{{ route('produto.index')}}'>Consultar</a></li> --}}
            </ul>
        </div>
        
        <div class="informacao-pagina">
            <div style=" margin-left: auto; margin-right: auto;">
          

                <table border="1" width='100%' style="text-align: center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Fornecedor</th>
                            <th>Peso</th>
                            <th>Unidade ID</th>
                            <th>Comprimento</th>
                            <th>Altura</th>
                            <th>Largura</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{ $produtos->toJson() }} --}}
                        @foreach ($produtos as $produto)
                        <tr>
                            <td>{{ $produto->id }}</td>
                            <td>{{ $produto->nome }}</td>
                            <td>{{ $produto->descricao }}</td>
                            <td>{{ $produto->fornecedor->name }}</td>
                            <td>{{ $produto->peso }}</td>
                            <td>{{ $produto->unidade_id }}</td>

                            {{-- <td>{{ $produto->comprimento ?? ''}}</td> --}}
                            <td>{{ $produto->produtoDetalhe->comprimento ?? ''}}</td>
                            <td>{{ $produto->produtoDetalhe->altura ?? ''}}</td>
                            <td>{{ $produto->produtoDetalhe->largura ?? ''}}</td>
                        
                            <td><a href="{{ route('produto.show', ['produto' => $produto->id] ) }}">Visualizar</a></td>
                            <td><a href="{{ route('produto.edit', ['produto' => $produto->id] ) }}">Editar</a></td>
                            <td>
                                <form id="form_{{$produto->id}}" action="{{ route('produto.destroy', ['produto' => $produto->id] ) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a onclick="document.getElementById('form_{{$produto->id}}').submit()" href="#">Excluir</a>
                                </form>
                            </td>
                        </tr>
                        
                        <tr>
                            <td colspan="12">Exibir o ID do Pedido(s) 
                                <p>Pedidos: 
                                    @foreach ($produto->pedidos as $pedido)
                                        <a href="{{ route('pedido-produto.create', ['pedido' => $pedido->id]) }}">
                                        <span style="margin-right:10px">{{ $pedido->id }}</span>
                                        </a>
                                    @endforeach
                                </p>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
                
                {{ $produtos->appends($request)->links()}}
                <br>
                
                {{--  
                {{ $fornecedores->count()}} - total por pagina
                <br>
                {{ $fornecedores->total()}} - total de registro por consulta
                <br>
                {{ $fornecedores->firstItem()}} - numero do primeiro registro da pagina
                <br>
                {{ $fornecedores->lastItem()}} - numero do ultimo registro da pagina
                --}}

                Exibindo {{ $produtos->count() }} produto de  {{ $produtos->total() }} (de  {{ $produtos->firstItem() }} a {{ $produtos->lastItem() }})
            </div>
        </div>
    </div>
@endsection