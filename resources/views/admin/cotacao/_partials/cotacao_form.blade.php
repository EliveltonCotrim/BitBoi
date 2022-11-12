<div class='form-row'>

    <div class='col-md-4'>
        <label>Date</label>
        <input type='date' name='date' value='{{ $cotacao->date ?? old("date")  }}' class='form-control'>
    </div>
    <div class='col-md-4'>
        <label>Valor</label>
        <input type='text' name='value' value='{{ $cotacao->value ?? old("value")  }}' class='form-control moeda'>
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