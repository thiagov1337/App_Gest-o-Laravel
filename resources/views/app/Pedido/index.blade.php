@extends('app.layouts.basico')

@section('titulo', 'Pedido')
   
@section('conteudo')

    
    <div class="conteudo-pagina">
        
        <div class="titulo-pagina-2">
            <p>Listagem de Pedidos</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href='{{ route('pedido.create')}}'>Novo</a></li>
                {{-- <li><a href='{{ route('produto.index')}}'>Consultar</a></li> --}}
            </ul>
        </div>
        
        <div class="informacao-pagina">
            <div style=" margin-left: auto; margin-right: auto;">

                <table border="1" width='100%' style="text-align: center">
                    <thead>
                        <tr>
                            <th>ID Pedido</th>
                            <th>Cliente</th>
                            <th></th>
                            <th></th>
                            <th></th>
      
                            
                        </tr>
                    </thead>
                    <tbody>
          
                        @foreach ($pedidos as $pedido)
                        <tr>
          
                            <td>{{ $pedido->id }}</td>
                            <td>{{ $pedido->cliente_id }}</td>

                            <td><a href="{{ route('pedido-produto.create', ['pedido' => $pedido->id] ) }}">Adicionar Produto</a></td>
                            <td><a href="{{ route('pedido.show', ['pedido' => $pedido->id] ) }}">Visualizar</a></td>
                            <td><a href="{{ route('pedido.edit', ['pedido' => $pedido->id] ) }}">Editar</a></td>
                            <td>
                                <form id="form_{{$pedido->id}}" action="{{ route('pedido.destroy', ['pedido' => $pedido->id] ) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a onclick="document.getElementById('form_{{$pedido->id}}').submit()" href="#">Excluir</a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                {{ $pedidos->appends($request)->links() }}
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

                Exibindo {{ $pedidos->count() }} produto de {{ $pedidos->total() }} (de  {{ $pedidos->firstItem() }} a {{ $pedidos->lastItem() }})
            </div>
        </div>
    </div>
@endsection