<div class='form-row'>
    <div class='col-md-4'>
        <label>Nome</label>
        <input type='text' name='name' value='{{ old('name') }}' class='form-control'>
    </div>
    <div class="col-md-4">
        <label for="">Moedas</label>
        <select id="coin" name="coin" class="form-control">
            <option value="" selected desable>Selecione uma Opção</option>
            @foreach ($coins as $coin)
                <option value="{{ $coin->id }}" {{ old('coin') == $coin->id ? 'selected' : '' }}>{{ $coin->name }}
                    - R$
                    {{ $coin->latestCotacao->value }} </option>
            @endforeach
        </select>
    </div>
</div>
<br>
<div class='form-row'>

    <div class="col-md-2">
        <label for="">Quantidade</label>
        <input type='number' name='quantity' value='{{ old('quantity') }}' class='form-control'>
    </div>

    <div class='col-md-3'>
        <label>Valor</label>
        <input type='text' name='value' value='{{ old('value') }}' class='form-control moeda'>
    </div>
    <div class='col-md-3'>
        <label>Percentual de Lucro(%)</label>
        <input type='text' name='percentual_rendimento' value='{{ old('percentual_rendimento') }}'
            class='form-control moeda'>
    </div>

</div>
<div class="form-row">
    <div class='col-md-3'>
        <label>Data para retorno de Investimento</label>
        <input  type='number' min="0"  class="form-control" name="time_pri" value="{{ old('time_pri') }}">
    </div>
</div>
<div class="form-row">
    <div class='col-md-8'>
        <label>Descrição</label>
        <textarea class="form-control" name="details" cols="30" rows="3" maxlength="350">{{ old('details') }}</textarea>
    </div>
</div>

<div class='form-row'>
    <div class='col-md-2'>
        <label>&nbsp;</label>
        <button type='submit' class='btn btn-primary form-control'>
            Salvar
        </button>
    </div>
</div>
