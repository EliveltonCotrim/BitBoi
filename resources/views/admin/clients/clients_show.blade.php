@extends('admin.index_admin')
@section('title', 'clients')

@section('actions')
<a href='<?php echo url('/admin/clients'); ?>' class='btn btn-primary'>
   Voltar
</a>@endsection

@section('content')

<div class='card'>
   <div class='card-body'>



      <div class='form-row'>
         <div class='col-md-4'>
            <label>Name</label>
            <input type='text' readonly value='{{ $clients->name }}' class='form-control'>
         </div>
         <div class='col-md-4'>
            <label>Email</label>
            <input type='text' readonly value='{{ $clients->email }}' class='form-control'>
         </div>
         <div class='col-md-4'>
            <label>User</label>
            <input type='text' readonly value='{{ $clients->user }}' class='form-control'>
         </div>
         <div class='col-md-4'>
            <label>Cpf</label>
            <input type='text' readonly value='{{ $clients->cpf }}' class='form-control'>
         </div>
         <div class='col-md-4'>
            <label>Password</label>
            <input type='text' readonly value='{{ $clients->password }}' class='form-control'>
         </div>
         <div class='col-md-4'>
            <label>Phone</label>
            <input type='text' readonly value='{{ $clients->phone }}' class='form-control'>
         </div>
         <div class='col-md-4'>
            <label>Uf</label>
            <input type='text' readonly value='{{ $clients->uf }}' class='form-control'>
         </div>
         <div class='col-md-4'>
            <label>City</label>
            <input type='text' readonly value='{{ $clients->city }}' class='form-control'>
         </div>
         <div class='col-md-4'>
            <label>Logradouro</label>
            <input type='text' readonly value='{{ $clients->logradouro }}' class='form-control'>
         </div>
         <div class='col-md-4'>
            <label>Number</label>
            <input type='text' readonly value='{{ $clients->number }}' class='form-control'>
         </div>
         <div class='col-md-4'>
            <label>Bairro</label>
            <input type='text' readonly value='{{ $clients->bairro }}' class='form-control'>
         </div>
         <div class='col-md-4'>
            <label>Cep</label>
            <input type='text' readonly value='{{ $clients->cep }}' class='form-control'>
         </div>
         <div class='col-md-4'>
            <label>Avatar</label>
            <input type='text' readonly value='{{ $clients->avatar }}' class='form-control'>
         </div>
         <div class='col-md-4'>
            <label>Status</label>
            <input type='text' readonly value='{{ $clients->status }}' class='form-control'>
         </div>
         <div class='col-md-4'>
            <label>EmailValidated</label>
            <input type='text' readonly value='{{ $clients->emailValidated }}' class='form-control'>
         </div>

      </div>
      <div class='form-row'>
         <div class='col-md-2'>
            <label>Excluir?</label>
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