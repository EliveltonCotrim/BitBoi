@extends('admin.index_admin')
@section('title', 'balances')

@section('actions')
   <a href='<?php echo url('/admin/balances'); ?>' class='btn btn-primary'>
      Voltar
  </a>@endsection

@section('content')

<div class='card'>
<div class='card-body'>



        <div class='form-row'>
            <div class='col-md-4'>
   <label >Cliente_id</label>
   <input type='text' readonly value='{{ $balances->cliente_id }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Reference</label>
   <input type='text' readonly value='{{ $balances->reference }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Type</label>
   <input type='text' readonly value='{{ $balances->type }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Operation</label>
   <input type='text' readonly value='{{ $balances->operation }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Moeda</label>
   <input type='text' readonly value='{{ $balances->moeda }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Rede</label>
   <input type='text' readonly value='{{ $balances->rede }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Value</label>
   <input type='text' readonly value='{{ $balances->value }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >CourentBalance</label>
   <input type='text' readonly value='{{ $balances->courentBalance }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >PreviousBalance</label>
   <input type='text' readonly value='{{ $balances->previousBalance }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Observation</label>
   <input type='text' readonly value='{{ $balances->observation }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Stats</label>
   <input type='text' readonly value='{{ $balances->stats }}' class='form-control'>
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
        