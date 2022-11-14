<div class='form-row'>
    <div class='col-md-4'>
        <label>Name</label>
        <input type='text' name='name' value='{{ old("name") ?? $coin->name  }}' class='form-control'>
    </div>
    <div class='col-md-4'>
        <label>Cotação Atual</label>
        <input type='text' name='cotacao_atual' value='@money2($coin->latestCotacao->value)' class='form-control moeda' reload>
    </div>
</div>
<br>

<div class='form-row'>

    <div class='col-md-4'>
        <label>Nova cotação</label>
        <input type='text' name='nova_cotacao' value='{{ old("nova_cotacao")  }}' class='form-control moeda'>
    </div>

    <div class="col-md-4">
        <label for="">Percentual de Lucro(%)</label>
        <input type='text' name='profit_percentage' value='{{ old("profit_percentage") ?? $coin->profit_percentage   }}' class='form-control percentual_lucro'>
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
