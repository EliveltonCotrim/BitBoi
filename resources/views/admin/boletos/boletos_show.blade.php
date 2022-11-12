@extends('admin.index_admin')
@section('title', 'boletos')

@section('actions')
   <a href='<?php echo url('/admin/boletos'); ?>' class='btn btn-primary'>
      Voltar
  </a>@endsection

@section('content')

<div class='card'>
<div class='card-body'>



        <div class='form-row'>
            <div class='col-md-4'>
   <label >Client_id</label>
   <input type='text' readonly value='{{ $boletos->client_id }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Cliente_plano_id</label>
   <input type='text' readonly value='{{ $boletos->cliente_plano_id }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Tipo</label>
   <input type='text' readonly value='{{ $boletos->tipo }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Valor</label>
   <input type='text' readonly value='{{ $boletos->valor }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >MeioPagamento</label>
   <input type='text' readonly value='{{ $boletos->meioPagamento }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Ticket</label>
   <input type='text' readonly value='{{ $boletos->ticket }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Status</label>
   <input type='text' readonly value='{{ $boletos->status }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >DataConfirmacao</label>
   <input type='text' readonly value='{{ $boletos->dataConfirmacao }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Obs</label>
   <input type='text' readonly value='{{ $boletos->obs }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Json</label>
   <input type='text' readonly value='{{ $boletos->json }}' class='form-control'>
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
        