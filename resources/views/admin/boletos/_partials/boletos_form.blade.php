

        <div class='form-row'>
            <div class='col-md-4'>
   <label >Client_id</label>
   <input type='text' name='client_id' value='{{ $boletos->client_id ?? old("client_id")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Cliente_plano_id</label>
   <input type='text' name='cliente_plano_id' value='{{ $boletos->cliente_plano_id ?? old("cliente_plano_id")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Tipo</label>
   <input type='text' name='tipo' value='{{ $boletos->tipo ?? old("tipo")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Valor</label>
   <input type='text' name='valor' value='{{ $boletos->valor ?? old("valor")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >MeioPagamento</label>
   <input type='text' name='meioPagamento' value='{{ $boletos->meioPagamento ?? old("meioPagamento")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Ticket</label>
   <input type='text' name='ticket' value='{{ $boletos->ticket ?? old("ticket")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Status</label>
   <input type='text' name='status' value='{{ $boletos->status ?? old("status")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >DataConfirmacao</label>
   <input type='text' name='dataConfirmacao' value='{{ $boletos->dataConfirmacao ?? old("dataConfirmacao")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Obs</label>
   <input type='text' name='obs' value='{{ $boletos->obs ?? old("obs")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Json</label>
   <input type='text' name='json' value='{{ $boletos->json ?? old("json")  }}' class='form-control'>
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