

        <div class='form-row'>
            <div class='col-md-4'>
   <label >Client_id</label>
   <input type='text' name='client_id' value='{{ $client_plan->client_id ?? old("client_id")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Plan_id</label>
   <input type='text' name='plan_id' value='{{ $client_plan->plan_id ?? old("plan_id")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Renovation</label>
   <input type='text' name='renovation' value='{{ $client_plan->renovation ?? old("renovation")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Expiration</label>
   <input type='text' name='expiration' value='{{ $client_plan->expiration ?? old("expiration")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Status</label>
   <input type='text' name='status' value='{{ $client_plan->status ?? old("status")  }}' class='form-control'>
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