<div class='form-row'>
   <div class='col-md-4'>
      <label>Name</label>
      <input type='text' required name='name' value='{{ $users->name ?? old("name")  }}' class='form-control'>
   </div>
   <div class='col-md-4'>
      <label>Email</label>
      <input type='text' required name='email' value='{{ $users->email ?? old("email")  }}' class='form-control'>
   </div>
   <div class='col-md-4'>
      <label>Senha</label>
      <input type='password' name='password' value='' class='form-control'>
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