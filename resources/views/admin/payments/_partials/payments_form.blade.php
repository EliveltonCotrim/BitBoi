

        <div class='form-row'>
            <div class='col-md-4'>
   <label >Name</label>
   <input type='text' name='name' value='{{ $payments->name ?? old("name")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Slug</label>
   <input type='text' name='slug' value='{{ $payments->slug ?? old("slug")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Logo</label>
   <input type='text' name='logo' value='{{ $payments->logo ?? old("logo")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Methods</label>
   <input type='text' name='methods' value='{{ $payments->methods ?? old("methods")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Status</label>
   <input type='text' name='status' value='{{ $payments->status ?? old("status")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Token</label>
   <input type='text' name='token' value='{{ $payments->token ?? old("token")  }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Data</label>
   <input type='text' name='data' value='{{ $payments->data ?? old("data")  }}' class='form-control'>
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