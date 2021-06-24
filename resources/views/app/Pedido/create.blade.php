@extends('app.layouts.basico')

@section('titulo', 'Pedido')
   
@section('conteudo')

    
    <div class="conteudo-pagina">
        
        <div class="titulo-pagina-2">
            @if (isset($pedido->id))
                <p>Editar Pedido</p>
            @else
                <p>Adicionar Pedido</p>    
            @endif
        </div>
        <div class="menu">
            <ul>
                <li><a href='{{ route('pedido.create')}}'>Novo</a></li>
                {{-- <li><a href='{{ route('produto.index')}}'>Consultar</a></li> --}}
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                @component('app.pedido._components.form_create_edit', ['clientes' => $clientes])  
                @endcomponent
            </div>
        </div>
    </div>
@endsection