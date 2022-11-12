<div class='form-row'>
    <div class='col-md-8'>
        <label>Name</label>
        <input type='text' name='name' value='{{ $plans->name ?? old("name")  }}' class='form-control'>
    </div>
</div>
<br>

<div class='form-row'>
    <div class='col-md-4'>
        <label>Valor</label>
        <input type='text' name='value' value='{{ $plans->value ?? old("value")  }}' class='form-control'>
    </div>


    <div class="col-md-4">
        <label for="">Quantidade</label>
        <input type='text' name='quantity' value='{{ $plans->quantity ?? old("quantity")  }}' class='form-control'>
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