@extends('admin.index_admin')
@section('title', 'client_plan')

@section('actions')
   <a href='<?php echo url('/admin/client_plan'); ?>' class='btn btn-primary'>
      Voltar
  </a>@endsection

@section('content')

<div class='card'>
<div class='card-body'>



        <div class='form-row'>
            <div class='col-md-4'>
   <label >Client_id</label>
   <input type='text' readonly value='{{ $client_plan->client_id }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Plan_id</label>
   <input type='text' readonly value='{{ $client_plan->plan_id }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Renovation</label>
   <input type='text' readonly value='{{ $client_plan->renovation }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Expiration</label>
   <input type='text' readonly value='{{ $client_plan->expiration }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Status</label>
   <input type='text' readonly value='{{ $client_plan->status }}' class='form-control'>
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
        