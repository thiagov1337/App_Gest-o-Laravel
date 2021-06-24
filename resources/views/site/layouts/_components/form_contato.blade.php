{{ $slot }}

<form action={{ route('site.contato') }} method='post'>
    @csrf
    <input type="text" value="{{old('name')}}" name="name" placeholder="Nome" class="{{$classe}}">
    @if ($errors->has('name'))
        {{$errors->first('name')}}
    @endif
    <br>
    <input type="text" value="{{old('telefone')}}" name="telefone" placeholder="Telefone" class="{{$classe}}">
    {{ $errors->has('telefone') ? $errors->first('telefone') : ''}}
    <br>
    <input type="text" value="{{old('email')}}" name="email" placeholder="E-mail" class="{{$classe}}">
    {{ $errors->has('email') ? $errors->first('email') : ''}}
    <br>
    <select class="{{$classe}}" name="motivo_contatos_id">
        <option value="">Qual o motivo do contato?</option>
        
        @foreach ($motivo as $key => $value)
            <option value="{{$value->id}}" {{(old('motivo_contatos_id') == $value->id) ? 'selected' : ''}}>{{$value->motivo_contato}}</option>
        @endforeach

    </select>
    {{ $errors->has('motivo_contatos_id') ? $errors->first('motivo_contatos_id') : ''}}
    <br>
    <textarea name="mensagem" class="{{$classe}}">{{ (old('mensagem') != '') ? old('mensagem') : 'Preencha aqui a sua mensagem'}}</textarea>
    {{ $errors->has('mensagem') ? $errors->first('mensagem') : ''}}
    <br>
    <button type="submit" class="{{$classe}}">ENVIAR</button>
</form>

{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}
