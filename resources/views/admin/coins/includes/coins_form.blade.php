<div class='form-row'>
    <div class='col-md-8'>
        <label>Name</label>
        <input type='text' name='name' value='{{ $coins->name ?? old("name")  }}' class='form-control'>
    </div>
</div>
<br>

<div class='form-row'>
    <div class='col-md-4'>
        <label>Valor</label>
        <input type='text' name='value' value='{{ $coins->value ?? old("value")  }}' class='form-control moeda'>
    </div>


    <div class="col-md-4">
        <label for="">Percentual de Lucro(%)</label>
        <input type='text' name='profit_percentage' value='{{ $coins->profit_percentage ?? old("profit_percentage")  }}' class='form-control percentual_lucro'>
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
