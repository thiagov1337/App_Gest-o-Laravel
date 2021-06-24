@extends('app.layouts.basico')

@section('titulo', 'Fornecedor')
   
@section('conteudo')

    
    <div class="conteudo-pagina">
        
        <div class="titulo-pagina-2">
            <p>Fornecedor</p>
        </div>

        <div class="menu">
            <ul>
                <li><a href={{ route('app.fornecedor.adicionar') }}>Novo</a></li>
                <li><a href={{ route('app.fornecedor') }}>Consultar</a></li>
            </ul>
        </div>

        <div class="informacao-pagina">
            <div style="width: 30%; margin-left: auto; margin-right: auto;">
                <form action={{ route('app.fornecedor.adicionar') }} method="POST">
                    @csrf
                    <input type="hidden" value="{{$fornecedor->id ?? ''}}" name="id">
                    
                    <input type="text" value="{{$fornecedor->name ?? old('name')}}" name="name" placeholder="Nome" class="borda-preta">
                    {{ $errors->has('name') ? $errors->first('name') : ''}}

                    <input type="text" value="{{$fornecedor->site ?? old('site')}}" name="site" placeholder="Site" class="borda-preta">
                    {{ $errors->has('site') ? $errors->first('site') : ''}}

                    <input type="text" value="{{$fornecedor->uf ?? old('uf')}}" name="uf" placeholder="UF" class="borda-preta">
                    {{ $errors->has('uf') ? $errors->first('uf') : ''}}

                    <input type="text" value="{{$fornecedor->email ?? old('email')}}" name="email" placeholder="E-mail" class="borda-preta">
                    {{ $errors->has('email') ? $errors->first('email') : ''}}
                    <button type="submit">Cadastrar</button>
                    
                  
                    {{$msg ?? ''}}
                   
                </form>
            </div>
        </div>
    </div>
@endsection