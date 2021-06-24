@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')
   
@section('conteudo')

    
    <div class="conteudo-pagina">
        
        <div class="titulo-pagina-2">
            <p>Fornecedor - Listar</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href={{ route('app.fornecedor.adicionar') }}>Novo</a></li>
                <li><a href={{ route('app.fornecedor') }}>Consultar</a></li>
            </ul>
        </div>
        
        <div class="informacao-pagina">
            <div style=" margin-left: auto; margin-right: auto;">
          

                <table border="1" width='100%'>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Site</th>
                            <th>UF</th>
                            <th>E-mail</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{ dd($fornecedores) }} --}}
                        @foreach ($fornecedores as $fornecedor)
                        <tr>
                            <td>{{ $fornecedor->name }}</td>
                            <td>{{ $fornecedor->site }}</td>
                            <td>{{ $fornecedor->uf }}</td>
                            <td>{{ $fornecedor->email }}</td>
                            <td><a href="{{ route('app.fornecedor.editar', $fornecedor->id) }}">Editar</a></td>
                            <td><a href="{{ route('app.fornecedor.excluir', $fornecedor->id) }}">Excluir</a></td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <p>Lista de Produtos</p>
                                <table border="1" style="margin: 20px">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                            <th>Peso</th>
                                        </tr>    
                                    </thead>
                                    <tbody>
                                        
                                        @foreach ($fornecedor->produtos as $key => $produto)
                                            <tr>
                                                <td>{{ $produto->id }}</td> 
                                                <td>{{ $produto->nome }}</td> 
                                                <td>{{ $produto->descricao }}</td> 
                                                <td>{{ $produto->peso }}</td> 
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                {{ $fornecedores->appends($request)->links()}}
                
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

                Exibindo {{ $fornecedores->count() }} fornecedore de  {{ $fornecedores->total() }} (de  {{ $fornecedores->firstItem() }} a {{ $fornecedores->lastItem() }})
            </div>
        </div>
    </div>
@endsection