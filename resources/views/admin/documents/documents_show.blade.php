@extends('admin.index_admin')
@section('title', 'documents')

@section('actions')
   <a href='<?php echo url('/admin/documents'); ?>' class='btn btn-primary'>
      Voltar
  </a>@endsection

@section('content')

<div class='card'>
<div class='card-body'>



        <div class='form-row'>
            <div class='col-md-4'>
   <label >Cliente_id</label>
   <input type='text' readonly value='{{ $documents->cliente_id }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Tipo</label>
   <input type='text' readonly value='{{ $documents->tipo }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Arquivo</label>
   <input type='text' readonly value='{{ $documents->arquivo }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Status</label>
   <input type='text' readonly value='{{ $documents->status }}' class='form-control'>
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
        