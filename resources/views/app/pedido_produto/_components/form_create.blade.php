
    <form action='{{ route('pedido-produto.store', ['pedido' => $pedido]) }}' method="POST">
        @csrf
        <select name="produto_id">
            <option>-- Selecione um Produto --</option>
            
            @foreach ($produtos as $produto)
                <option value="{{ $produto->id }}" {{  old('produto_id') == $produto->id ? 'selected' : ''}}>{{ $produto->nome }}</option>
            @endforeach

        </select>
        {{ $errors->has('produto_id') ? $errors->first('produto_id') : ''}}
        
        <input name="quantidade" type="number" value="{{ old('quantidade') ? old('quantidade') : '' }}" placeholder="Quantidade" class="border-preta">
        {{ $errors->has('quantidade') ? $errors->first('quantidade') : ''}}

        <button type="submit">Cadastrar</button>
</form>