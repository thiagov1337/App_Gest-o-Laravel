<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>4
    <body>
        
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Fornecedor (View)*
                    
                </div>
               
                <div class="links">
                    <a href="{{route('site.sobrenos')}}">Sobre-nos</a>
                    <a href="{{route('site.contato')}}">Contato</a>
                    <a href="{{route('site.index')}}">principal</a>
                    <!-- <a href="https://blog.laravel.com">Blog</a>
                    <a href="https://nova.laravel.com">Nova</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://vapor.laravel.com">Vapor</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a> -->
                </div>
                    {{-- sintaxe do blade --}}
                   @if(count($fornecedores) > 0 && count($fornecedores) < 10)
                        <h3>Existe alguns fornecedores</h3>
                   @elseif(count($fornecedores) > 10)
                        <h3>Existe muitos fornecedores</h3>
                   @else
                        <h3>Não tem fornecedores</h3>
                   @endif
                
                   <h3>
                        Fornecedores: {{''.$fornecedores['Fornecedor2']['nome']}}
                        <br>
                        Status: {{$fornecedores['Fornecedor2']['status']}}
                        <br>
                    
                   @unless($fornecedores['Fornecedor2']['status'] == 'I') {{-- inverte o resultado o if  --}}
                        Fornecedor INATIVO
                   @else
                        Fornecedor ATIVO
                   @endunless
                   <Br>
                    CNPJ: {{$fornecedores['Fornecedor2']['CNPJ'] ?? 'Dado Não foi preenchido' }} {{-- Valor Default 
                            $variavel testada não estiver definida (isset)
                                            ou
                            $variavel testada possuir o valor null 
                     --}}
                   @forelse($fornecedores as $key => $valores)
                        <br> {{ $loop->iteration }}
                   
                        @if ($loop->first)
                            primeiro <br>
                        @endif

                            @if ($loop->last)
                                ultima <br> 
                                Total : {{ $loop->count }}
                        @endif
                        
                   @empty
                    vazio
                   @endforelse
                   <br>@{{ignorado}}
                   </h3>
            </div>
            
        </div>
        @isset($fornecedores)
         @dd($fornecedores);
        @endisset
    </body>
    
</html>
