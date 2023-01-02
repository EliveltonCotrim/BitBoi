<div class='form-row'>
    <div class='col-md-8'>
        <label>Nome</label>
        <input type='text' name='name' value='{{ old('name') }}' class='form-control'>
    </div>
</div>
<br>
<div class='form-row'>
    <div class='col-md-4'>
        <label>Valor</label>
        <input type='text' name='value' value='{{ old('value') }}' class='form-control moeda'>
    </div>

    <div class="col-md-4">
        <label for="">Percentual de Lucro(%)</label>
        <input type='text' name='profit_percentage' value='{{ old('profit_percentage') }}'
            class='form-control percentual_lucro'>
    </div>
</div>
<br>
<div class='form-row'>
    <div class='col-md-3'>
        <label>Tempo para retorno de investimento</label>
        <input type='number' name='time_pri' min="0" value='{{ old('time_pri') }}' class='form-control'>
    </div>
    <div class='col-md-2'>
        <label>Qunatidade de Boi</label>
        <input type='number' name='qtd_boi' min="0" value='{{ old('qtd_boi') }}' class='form-control'>
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
