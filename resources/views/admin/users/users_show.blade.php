@extends('admin.index_admin')
@section('title', 'users')

@section('actions')
   <a href='<?php echo url('/admin/users'); ?>' class='btn btn-primary'>
      Voltar
  </a>@endsection

@section('content')

<div class='card'>
<div class='card-body'>



        <div class='form-row'>
            <div class='col-md-4'>
   <label >Name</label>
   <input type='text' readonly value='{{ $users->name }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Email</label>
   <input type='text' readonly value='{{ $users->email }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Email_verified_at</label>
   <input type='text' readonly value='{{ $users->email_verified_at }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Password</label>
   <input type='text' readonly value='{{ $users->password }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Remember_token</label>
   <input type='text' readonly value='{{ $users->remember_token }}' class='form-control'>
</div>

        </div>
        <div class='form-row'>
            <div class='col-md-2'>
                <label >Excluir?</label>
                <button type='submit' class='btn btn-primary form-control'>
                    Excluir
                </button>
            </div>
        </div>
        
               </div>
    </div>
</div>
</div>
</div>
@endsection
        