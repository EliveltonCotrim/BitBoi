@extends('admin.index_admin')
@section('title', 'plans')

@section('actions')
   <a href='<?php echo url('/admin/plans'); ?>' class='btn btn-primary'>
      Voltar
  </a>@endsection

@section('content')

<div class='card'>
<div class='card-body'>



        <div class='form-row'>
            <div class='col-md-4'>
   <label >Name</label>
   <input type='text' readonly value='{{ $plans->name }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Value</label>
   <input type='text' readonly value='{{ $plans->value }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Days</label>
   <input type='text' readonly value='{{ $plans->days }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Details</label>
   <input type='text' readonly value='{{ $plans->details }}' class='form-control'>
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
        