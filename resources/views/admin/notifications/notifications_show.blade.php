@extends('admin.index_admin')
@section('title', 'notifications')

@section('actions')
   <a href='<?php echo url('/admin/notifications'); ?>' class='btn btn-primary'>
      Voltar
  </a>@endsection

@section('content')

<div class='card'>
<div class='card-body'>



        <div class='form-row'>
            <div class='col-md-4'>
   <label >Title</label>
   <input type='text' readonly value='{{ $notifications->title }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Text</label>
   <input type='text' readonly value='{{ $notifications->text }}' class='form-control'>
</div>
<div class='col-md-4'>
   <label >Status</label>
   <input type='text' readonly value='{{ $notifications->status }}' class='form-control'>
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
        