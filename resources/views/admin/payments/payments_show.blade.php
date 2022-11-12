@extends('admin.index_admin')
@section('title', 'payments')

@section('actions')
   <a href='<?php echo url('/admin/payments'); ?>' class='btn btn-primary'>
      Voltar
  </a>@endsection

@section('content')

<div class='card'>
<div class='card-body'>



        <div class='form-row'>
            <div class='col-md-4'>
   <label >Name</label>
   <input type='text' readonly value='{{ $payments->name }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Slug</label>
   <input type='text' readonly value='{{ $payments->slug }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Logo</label>
   <input type='text' readonly value='{{ $payments->logo }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Methods</label>
   <input type='text' readonly value='{{ $payments->methods }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Status</label>
   <input type='text' readonly value='{{ $payments->status }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Token</label>
   <input type='text' readonly value='{{ $payments->token }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Data</label>
   <input type='text' readonly value='{{ $payments->data }}' class='form-control'>
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
        