<div class='form-row'>
    <div class='col-md-4'>
        <label>Name</label>
        <input type='text' name='name' value='{{ old('name') ?? $coin->name }}' class='form-control'>
    </div>
    <div class='col-md-4'>
        <label>Cotação Atual</label>
        <input type='text' name='cotacao_atual' value='@money2($coin->latestCotacao->value)' class='form-control moeda' readonly>
    </div>
</div>
<br>

<div class='form-row'>

    <div class='col-md-4'>
        <label>Nova cotação</label>
        <input type='text' name='nova_cotacao' value='{{ old('nova_cotacao') }}' class='form-control moeda'>
    </div>

    <div class="col-md-4">
        <label for="">Percentual de Lucro(%)</label>
        <input type='text' name='profit_percentage'
            value='{{ old('profit_percentage') ?? $coin->profit_percentage }}' class='form-control percentual_lucro'>
    </div>
</div>
<div class='form-row'>
    <div class='col-md-3'>
        <label>Tempo para retorno de investimento</label>
        <input type='number' name='time_pri' min="0" value='{{ $coin->time_pri ?? old('time_pri') }}'
            class='form-control'>
    </div>
    <div class='col-md-2'>
        <label>Qunatidade de Boi</label>
        <input type='number' name='qtd_boi' min="0" value='{{ $coin->qtd_boi ?? old('qtd_boi') }}'
            class='form-control'>
    </div>
</div>
<div class='form-row mt-3'>
    <div class='col-md-8'>

        <label>Status</label>
        <br>
        <label for="active">
            <input {{ $coin->status == 'active' ? 'checked' : '' }} value="active" id="active" type='radio'
                name='status' class='form-contro'>
            Active
        </label>

        <label for="inactive">
            <input {{ $coin->status == 'inactive' ? 'checked' : '' }} value="inactive" id="inactive" type='radio'
                name='status' class='form-contro'>
            Inactive
        </label>
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
