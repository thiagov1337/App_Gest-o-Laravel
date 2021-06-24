@if (isset($produto->id))
<form action='{{ route('produto.update', ['produto' => $produto->id]) }}' method="POST">
    @csrf
    @method('PUT')
@else
<form action='{{ route('produto.store') }}' method="POST">
    @csrf
@endif

<select name="fornecedor_id">
    <option>-- Tipo Unidades de Medidas --</option>
    
    @foreach ($fornecedores as $fornecedor)
        <option value="{{ $fornecedor->id }}" {{ ( $produto->fornecedor_id ?? old('fornecedor_id') ) == $fornecedor->id ? 'selected' : ''}}>{{ $fornecedor->name }}</option>
    @endforeach

</select>
{{ $errors->has('fornecedor_id') ? $errors->first('fornecedor_id') : ''}}


<input type="text" value="{{ $produto->nome ?? old('nome') }}" name="nome" placeholder="Nome" class="borda-preta">
{{ $errors->has('nome') ? $errors->first('nome') : ''}}

<input type="text" value="{{ $produto->descricao ?? old('descricao') }}" name="descricao" placeholder="Descrição" class="borda-preta">
{{ $errors->has('descricao') ? $errors->first('descricao') : ''}}

<input type="text" value="{{ $produto->peso ?? old('peso') }}" name="peso" placeholder="Peso" class="borda-preta">
{{ $errors->has('peso') ? $errors->first('peso') : ''}}

<select name="unidade_id">
    <option>-- Tipo Unidades de Medidas --</option>
    
    @foreach ($unidades as $unidade)
        <option value="{{ $unidade->id }}" {{ ( $produto->unidade_id ?? old('unidade_id') ) == $unidade->id ? 'selected' : ''}}>{{ $unidade->descricao }}</option>
    @endforeach

</select>
{{ $errors->has('unidade_id') ? $errors->first('unidade_id') : ''}}

<button type="submit">Cadastrar</button>

</form>