<div class='form-row'>
   <div class='col-md-4'>
      <label>Name</label>
      <input type='text' required name='name' value='{{ $clients->name ?? old("name")  }}' class='form-control'>
   </div>

   <div class='col-md-4'>
      <label>User</label>
      <input type='text' name='user' value='{{ $clients->user ?? old("user")  }}' class='form-control'>
   </div>


</div>
<div class='form-row'>

   <div class='col-md-4'>
      <label>Email</label>
      <input type='text' required name='email' value='{{ $clients->email ?? old("email")  }}' class='form-control'>
   </div>

   <div class='col-md-4'>
      <label>Senha</label>
      <input type='text' required name='password' value='{{ $clients->password ?? old("password")  }}' class='form-control'>
   </div>

</div>
<div class='form-row'>
   <div class='col-md-4'>
      <label>Cpf</label>
      <input type='text' name='cpf' value='{{ $clients->cpf ?? old("cpf")  }}' class='form-control'>
   </div>

   <div class='col-md-3'>
      <label>Phone</label>
      <input type='text' name='phone' value='{{ $clients->phone ?? old("phone")  }}' class='form-control'>
   </div>
   <div class='col-md-1'>
      <label>Uf</label>
      <input type='text' name='uf' value='{{ $clients->uf ?? old("uf")  }}' class='form-control'>
   </div>
</div>
<div class='form-row'>
   <div class='col-md-3'>
      <label>City</label>
      <input type='text' name='city' value='{{ $clients->city ?? old("city")  }}' class='form-control'>
   </div>
   <div class='col-md-3'>
      <label>Logradouro</label>
      <input type='text' name='logradouro' value='{{ $clients->logradouro ?? old("logradouro")  }}' class='form-control'>
   </div>
   <div class='col-md-2'>
      <label>Number</label>
      <input type='text' name='number' value='{{ $clients->number ?? old("number")  }}' class='form-control'>
   </div>
</div>
<div class='form-row'>
   <div class='col-md-4'>
      <label>Bairro</label>
      <input type='text' name='bairro' value='{{ $clients->bairro ?? old("bairro")  }}' class='form-control'>
   </div>
   <div class='col-md-4'>
      <label>Cep</label>
      <input type='text' name='cep' value='{{ $clients->cep ?? old("cep")  }}' class='form-control'>
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