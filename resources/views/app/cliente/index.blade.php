@extends('app.layouts.basico')

@section('titulo', 'Cliente')
   
@section('conteudo')

    
    <div class="conteudo-pagina">
        
        <div class="titulo-pagina-2">
            <p>Listagem de Clientes</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href='{{ route('cliente.create')}}'>Novo</a></li>
                {{-- <li><a href='{{ route('produto.index')}}'>Consultar</a></li> --}}
            </ul>
        </div>
        
        <div class="informacao-pagina">
            <div style=" margin-left: auto; margin-right: auto;">

                <table border="1" width='100%' style="text-align: center">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th></th>
                            <th></th>
                            <th></th>
      
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                        <tr>
          
                            <td>{{ $cliente->nome }}</td>

                            <td><a href="{{ route('cliente.show', ['cliente' => $cliente->id] ) }}">Visualizar</a></td>
                            <td><a href="{{ route('cliente.edit', ['cliente' => $cliente->id] ) }}">Editar</a></td>
                            <td>
                                <form id="form_{{$cliente->id}}" action="{{ route('cliente.destroy', ['cliente' => $cliente->id] ) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a onclick="document.getElementById('form_{{$cliente->id}}').submit()" href="#">Excluir</a>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                {{ $clientes->appends($request)->links() }}
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

                Exibindo {{ $clientes->count() }} produto de {{ $clientes->total() }} (de  {{ $clientes->firstItem() }} a {{ $clientes->lastItem() }})
            </div>
        </div>
    </div>
@endsection