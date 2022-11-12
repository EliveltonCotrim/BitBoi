

        <div class='form-row'>
            <div class='col-md-4'>
   <label >Cliente_id</label>
   <input type='text' name='cliente_id' value='{{ $balances->cliente_id ?? old("cliente_id")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Reference</label>
   <input type='text' name='reference' value='{{ $balances->reference ?? old("reference")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Type</label>
   <input type='text' name='type' value='{{ $balances->type ?? old("type")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Operation</label>
   <input type='text' name='operation' value='{{ $balances->operation ?? old("operation")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Moeda</label>
   <input type='text' name='moeda' value='{{ $balances->moeda ?? old("moeda")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Rede</label>
   <input type='text' name='rede' value='{{ $balances->rede ?? old("rede")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Value</label>
   <input type='text' name='value' value='{{ $balances->value ?? old("value")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >CourentBalance</label>
   <input type='text' name='courentBalance' value='{{ $balances->courentBalance ?? old("courentBalance")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >PreviousBalance</label>
   <input type='text' name='previousBalance' value='{{ $balances->previousBalance ?? old("previousBalance")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Observation</label>
   <input type='text' name='observation' value='{{ $balances->observation ?? old("observation")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Stats</label>
   <input type='text' name='stats' value='{{ $balances->stats ?? old("stats")  }}' class='form-control'>
</div>

        </div>
        <div class='form-row'>
            <div class='col-md-2'>
                <label >&nbsp;</label>
                <button type='submit' class='btn btn-primary form-control'>
                    Salvar
                </button>
            </div>
        </div>